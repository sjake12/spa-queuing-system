import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, usePage } from '@inertiajs/react';
import StudentDashboard from "@/Components/StudentDashboard.jsx";

export default function Dashboard({ queueUpdate, paymentStatus, eventAttendance }) {
    const { role } = usePage().props.auth.user;
    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800" >
                    Dashboard
                </h2 >
            }
        >
            <Head title="Dashboard" />

            <div className="py-12" >
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8" >
                    { role === 'user' &&
                        <StudentDashboard
                            queueUpdate={queueUpdate}
                            paymentStatus={paymentStatus}
                            eventAttendance={eventAttendance}
                        />
                    }
                </div >
            </div >
        </AuthenticatedLayout >
    );
}
