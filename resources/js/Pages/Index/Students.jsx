import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.jsx";
import { Head, Link, usePage } from "@inertiajs/react";
import PrimaryButton from "@/Components/PrimaryButton.jsx";

export default function Students() {
    const { students } = usePage().props;

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
                                    </tr >
                                </thead >
                                <tbody className="bg-white divide-y divide-gray-200" >
                                    {students.map((student) => (
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
                                                <Link href={route('users.edit', student.student_id)} className="py-2 px-4 bg-blue-700 hover:bg-blue-500 text-white rounded-md mr-2">
                                                    Edit
                                                </Link>
                                                <Link href={route('users.delete', student.student_id)} className="py-2 px-4 bg-red-700 hover:bg-red-500 text-white rounded-md">
                                                    Delete
                                                </Link>
                                            </td >
                                        </tr >
                                    ))}
                                </tbody >
                            </table >
                        </div >
                    </div >
                </div >
            </div>
        </AuthenticatedLayout >
)
}
