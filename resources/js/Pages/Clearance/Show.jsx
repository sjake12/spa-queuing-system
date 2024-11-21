import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.jsx";
import { Head, Link, usePage } from "@inertiajs/react";
import PermissionGate from "@/Pages/Auth/PermissionGate.jsx";
import ClearanceStatus from "@/Pages/Clearance/Partials/ClearanceStatus.jsx";
import React from "react";
import SecondaryButton from "@/Components/SecondaryButton.jsx";
import PrimaryButton from "@/Components/PrimaryButton.jsx";

export default function Show() {
    const { signingOffice } = usePage().props;

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
                            Signing office clearance requirements goes here
                        </div >
                    </div >
                </div >
            </div >
        </AuthenticatedLayout >
    )
}
