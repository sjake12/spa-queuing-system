import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.jsx";
import { Head, Link } from "@inertiajs/react";
import { Button } from "@mui/material";

export default function Office({ queue }){

    return (
         <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800" >
                    Your Queue
                </h2 >
            }
         >
            <Head title="Queue Updates" />

            <div className="py-12" >
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8" >
                    <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg" >
                        <div className="p-6 text-gray-900" >
                            <h2 className="text-xl font-semibold mb-6" >Students in Queue</h2 >

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
                                    {queue.length > 0 ? queue.map((student) => (
                                        <tr key={student.student_id} >
                                            <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900" >
                                                {student.student_id}
                                            </td >
                                            <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900" >
                                                {student.student_name}
                                            </td >
                                            <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900" >
                                                {student.course}
                                            </td >
                                            <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900" >
                                                <Button
                                                    variant="contained"
                                                    href={route('queue.show-clearance', (student.student_id))}
                                                >
                                                    View
                                                </Button>
                                            </td >
                                        </tr >
                                    )) : (
                                        <p className="mt-6 text-gray-500">
                                            No students in queue
                                        </p>
                                    )}
                                </tbody >
                            </table >
                        </div >
                    </div >
                </div >
            </div >
         </AuthenticatedLayout >
    );
}
