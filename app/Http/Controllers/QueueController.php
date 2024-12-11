<?php

namespace App\Http\Controllers;

use App\Models\Payments;
use App\Models\Queue;
use App\Models\SigningOffice;
use App\Models\Student;
use Illuminate\Http\Request;
use Inertia\Inertia;

class QueueController extends Controller
{
    public function index()
    {
        $signing_offices = SigningOffice::all();

        // Fetch queues with related student and signing office data
        $queues = Queue::with(['student', 'signingOffice'])
            ->orderBy('signing_office_id')
            ->orderBy('created_at')
            ->get()
            ->map(function ($queue) {
                return [
                    'queue_id' => $queue->id,
                    'student_id' => $queue->student_id,
                    'student_name' => $queue->student->first_name . ' ' . $queue->student->last_name,
                    // Assuming 'name' is a column in the students table
                    'signing_office_id' => $queue->signing_office_id,
                    'signing_office_name' => $queue->signingOffice->office_name,
                    'status' => $queue->status,
                ];
            });

        return Inertia::render('Queue/Office', [
            'signing_offices' => $signing_offices->map(function ($signingOffice) {
                return [
                    'office_id' => $signingOffice->office_id,
                    'office_name' => $signingOffice->office_name,
                    'signing_sequence' => $signingOffice->signing_sequence,
                    'is_active' => $signingOffice->isActive,
                ];
            }),
            'queues' => $queues,
        ]);
    }

    public function show(Student $student)
    {
        $signing_offices = SigningOffice::all();

        $status = Queue::where('student_id', $student->student_id)
            ->where('status', 'pending')
            ->first();

        return Inertia::render('Queue/Show', [
            'signing_offices' => $signing_offices->map(function ($signingOffice) {
                return [
                    'office_id' => $signingOffice->office_id,
                    'office_name' => $signingOffice->office_name,
                    'signing_sequence' => $signingOffice->signing_sequence,
                    'is_active' => $signingOffice->isActive,
                ];
            }),
            'status' => $status,
        ]);
    }

    public function officeQueue(SigningOffice $signingOffice)
    {
        $queue = Queue::where('signing_office_id', $signingOffice->office_id)
            ->where('status', 'pending')->get();

        return Inertia::render('Queue/Office', [
            'queue' => $queue->map(function ($queue) {
                return [
                    'queue_id' => $queue->id,
                    'student_id' => $queue->student_id,
                    'student_name' => $queue->student->first_name . ' ' . $queue->student->last_name,
                    // Assuming 'name' is a column in the students table
                    'course' => $queue->student->course,
                    'signing_office_id' => $queue->signing_office_id,
                    'signing_office_name' => $queue->signingOffice->office_name,
                    'status' => $queue->status,
                ];
            }),
        ]);
    }

    public function studentClearance(Student $student)
    {
        $officeId = SigningOffice::where('office_name', auth()->user()->student->rolesWithoutTeam->first()->name)->value('office_id');
        $payments = Payments::where('office_id', $officeId)->get();

        return Inertia::render('Queue/Student', [
            'payments' => $payments->map(function ($payment) use ($student) {
                return [
                    'student_name' => $student->first_name,
                    'payment_id' => $payment->id,
                    'payment_name' => $payment->for,
                    'payment_type' => $payment->payment_type,
                    'amount' => $payment->amount,
                    'is_paid' => $payment->paymentStatus->where('student_id', $student->student_id)->first()->is_paid,
                ];
            }),
            'student' => [
                'student_id' => $student->student_id,
                'student_name' => $student->first_name
            ],
            'officeId' => $officeId,
            'queueId' => Queue::where('student_id', $student->student_id)
                ->where('status', 'pending')
                ->first()
                ->id,
        ]);
    }

    public function startQueue(Request $request)
    {
        $studentId = $request->user()->username;

        // Get the first signing office
        $firstOffice = SigningOffice::where('isActive', true)
            ->orderBy('signing_sequence')
            ->firstOrFail();

        // Add student to the first queue
        Queue::create([
            'student_id' => $studentId,
            'signing_office_id' => $firstOffice->office_id,
        ]);

        return redirect()->back()->with('success', 'Show started.');
    }

    public function approveQueue(Request $request, Queue $queue)
    {
        // Mark the current queue as approved
        $queue->update(['status' => 'approved']);

        // Check for the next signing office
        $nextOffice = SigningOffice::where(
            'signing_sequence',
            '>',
            $queue->signingOffice->signing_sequence,
        )
            ->orderBy('signing_sequence')
            ->first();
        if ($nextOffice) {
            // Add student to the next office queue
            Queue::firstOrCreate([
                'student_id' => $queue->student_id,
                'signing_office_id' => $nextOffice->office_id,
            ]);
        } else {
            // Issue exam permit if it's the last office
            $this->issueExamPermit($queue->student_id);
        }

        return redirect()->back()->with('success', 'Show approved.');
    }

    protected function issueExamPermit($studentId)
    {
        // Logic to issue the exam permit
        // e.g., updating a database field or generating a downloadable document
        $student = Student::find($studentId);
        $student->update(['exam_permit_issued' => true]);
    }
}
