import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';

export default function Dashboard() {
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
                    <div className="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3" >
                        <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg" >
                            <div className="p-6 text-gray-900" >
                                Students on Queue
                                <p >12345</p >
                            </div >
                        </div >
                        <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg" >
                            <div className="p-6 text-gray-900" >
                                Cleared Students
                                <p >12345</p >
                            </div >
                        </div >
                        <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg" >
                            <div className="p-6 text-gray-900" >
                                Students on Queue
                                <p >12345</p >
                            </div >
                        </div >
                    </div >
                </div >
            </div >
        </AuthenticatedLayout >
    );
}
