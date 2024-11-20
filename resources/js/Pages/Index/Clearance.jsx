import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.jsx";
import { Head, Link, usePage } from "@inertiajs/react";
import PermissionGate from "@/Pages/Auth/PermissionGate.jsx";
import React from "react";
import ClearanceStatus from "@/Pages/Clearance/Partials/ClearanceStatus.jsx";

export default function Clearance() {
    const { isClearanceOnGoing } = usePage().props.auth;
    const signingOffices = usePage().props.signingOffices;

    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800" >
                    Clearance
                </h2 >
            }
        >
            <Head title="Clearance" />

            <div className="py-12" >
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8" >
                    <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg" >
                        <div className="p-6 text-gray-900" >
                            {isClearanceOnGoing ? (
                                <>
                                    <PermissionGate permission="view_clearances" >
                                        <ClearanceStatus signingOffices={signingOffices} />
                                    </PermissionGate>

                                    <PermissionGate permission="end_clearance" >
                                        <Link
                                            href={route('clearance.end')}
                                            method="post"
                                            as="button"
                                            className="bg-red-500 hover:bg-red-400 text-white font-bold py-2 px-4 rounded mt-4"
                                        >
                                            End Clearance
                                        </Link >
                                    </PermissionGate >
                                </>
                            ) : (
                                <div >
                                    <p >Coming Soon...</p >

                                    <PermissionGate permission="start_clearance" >
                                        <Link
                                            href={route('clearance.start')}
                                            method="post"
                                            as="button"
                                            className="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 rounded mt-4"
                                        >
                                            Start Clearance
                                        </Link >
                                    </PermissionGate >
                                </div >
                            )}
                        </div >
                    </div >
                </div >
            </div >
        </AuthenticatedLayout >
    )
}
