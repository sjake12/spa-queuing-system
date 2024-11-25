import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.jsx";
import { Head, Link, usePage } from "@inertiajs/react";
import React from "react";
import PrimaryButton from "@/Components/PrimaryButton.jsx";

export default function Show() {
    const { signingOffice, events, payments } = usePage().props;

    return (
        <AuthenticatedLayout
            header={
                <div className="flex justify-between items-center">
                    <h2 className="text-xl font-semibold leading-tight text-gray-800" >
                        {signingOffice.office_name}
                    </h2 >

                    <Link href={route('clearance')} >
                        <PrimaryButton className="bg-red-500">
                            Back
                        </PrimaryButton>
                    </Link>
                </div >
            }
        >
            <Head title={`${signingOffice.office_name} - Requirements`} />

            <div className="py-12" >
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8" >
                    <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg" >
                        <div className="p-6 text-gray-900" >
                            <h2 className="font-semibold text-2xl mb-6" >
                                Requirements
                            </h2 >
                            {events.map((event, index) => (
                                <h2 >{event.event_name}</h2 >
                            ))}
                        </div >
                    </div >
                </div >
            </div >
        </AuthenticatedLayout >
    )
}
