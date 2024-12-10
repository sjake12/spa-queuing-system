import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.jsx";
import { Head, Link, usePage } from "@inertiajs/react";
import PrimaryButton from "@/Components/PrimaryButton.jsx";
import SearchBar from "@/Components/SearchBar.jsx";
import { useState } from "react";

export default function Students() {
    const { students } = usePage().props;
    const [searchQuery, setSearchQuery] = useState('');

    // Filter students based on selected program and search query
    const filteredStudents = students.filter(student =>
        (searchQuery === '' ||
            String(student.student_id).toLowerCase().includes(searchQuery.toLowerCase()) ||
            student.first_name.toLowerCase().includes(searchQuery.toLowerCase()) ||
            student.last_name.toLowerCase().includes(searchQuery.toLowerCase())
        )
    );

    return (
        <AuthenticatedLayout
            header={
                <div className="flex justify-between">
                    <h2 className="text-xl font-semibold leading-tight text-gray-800" >
                        Students
                    </h2 >

                    <Link href={route('users.create')}>
                        <PrimaryButton>
                            Add Student
                        </PrimaryButton>
                    </Link>
                </div>
            }
        >
            <Head title="Students" />

            <div className="py-12" >
                <div className="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8" >
                    <div className="bg-white p-4 shadow sm:rounded-lg sm:p-8" >
                        <div className="p-6 text-gray-900" >
                            <input
                                type="text"
                                placeholder="Search students by ID, name..."
                                value={searchQuery}
                                onChange={(e) => setSearchQuery(e.target.value)}
                                className="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 mb-6"
                            />

                            <table className="min-w-full divide-y divide-gray-200" >
                                <thead >
                                    <tr >
                                        <th className="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" >
                                            ID Number
                                        </th >
                                        <th className="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" >
                                            Full Name
                                        </th >
                                        <th className="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" >
                                            Course
                                        </th >
                                        <th className="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" >
                                            Actions
                                        </th >
                                    </tr >
                                </thead >
                                <tbody className="bg-white divide-y divide-gray-200" >
                                    {filteredStudents.map((student) => (
                                        <tr key={student.student_id} >
                                            <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900" >
                                                {student.student_id}
                                            </td >
                                            <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900" >
                                                {student.first_name} {student.last_name}
                                            </td >
                                            <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900" >
                                                {student.course}
                                            </td >
                                            <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900" >
                                                <Link href={route('users.edit', student.student_id)}
                                                      className="py-2 px-4 bg-blue-700 hover:bg-blue-500 text-white rounded-md mr-2" >
                                                    Edit
                                                </Link >
                                                <button
                                                    onClick={() => {
                                                        if (confirm('Are you sure you want to delete this student?')) {
                                                            window.location.href = route('users.delete', student.student_id);
                                                        }
                                                    }}
                                                    className="py-2 px-4 bg-red-700 hover:bg-red-500 text-white rounded-md"
                                                >
                                                    Delete
                                                </button >
                                            </td >
                                        </tr >
                                    ))}
                                </tbody >
                            </table >
                        </div >
                    </div >
                </div >
            </div >
        </AuthenticatedLayout >
    )
}
