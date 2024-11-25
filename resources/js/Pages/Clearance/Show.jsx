import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.jsx";
import { Head, Link, usePage } from "@inertiajs/react";
import React from "react";
import PrimaryButton from "@/Components/PrimaryButton.jsx";

export default function Show() {
    const { requirements, office_name } = usePage().props;
    return (
        <AuthenticatedLayout
            header={
                <div className="flex justify-between items-center">
                    <h2 className="text-xl font-semibold leading-tight text-gray-800" >
                        {office_name}
                    </h2 >

                    <Link href={route('clearance')} >
                        <PrimaryButton className="bg-red-500">
                            Back
                        </PrimaryButton>
                    </Link>
                </div >
            }
        >
            <Head title={`${requirements.office_name} - Requirements`} />

            <div className="py-12" >
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8" >
                    <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg" >
                        <div className="p-6 text-gray-900" >
                            <h2 className="font-semibold text-2xl mb-6" >
                                Requirements
                            </h2 >
                            <table className="min-w-full divide-y divide-gray-200" >
                                <thead >
                                    <tr >
                                        <th className="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" >
                                             Name
                                        </th >
                                        <th className="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" >
                                            Type
                                        </th >
                                        <th className="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" >
                                            Amount
                                        </th >
                                    </tr >
                                </thead >
                                <tbody className="bg-white divide-y divide-gray-200" >
                                    { requirements.length > 0 ? requirements.map((requirement) => (
                                        <tr key={requirement.requirement_id} >
                                            <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900" >
                                                {requirement.requirement_name}
                                            </td >
                                            <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900" >
                                                {requirement.requirement_type}
                                            </td >
                                            <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900" >
                                                {requirement.amount}
                                            </td >
                                        </tr >
                                    )) : (
                                        <p className="w-full mt-8 font-bold text-red-500 text-center">
                                            No requirements found!
                                        </p>
                                    )}
                                </tbody >
                            </table >
                        </div >
                    </div >
                </div >
            </div >
        </AuthenticatedLayout >
    )
}
