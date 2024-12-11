import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.jsx";
import { Head, Link, router, useForm } from "@inertiajs/react";
import React, { useState } from "react";
import PrimaryButton from "@/Components/PrimaryButton.jsx";
import { Button, IconButton, Snackbar } from "@mui/material";
import CloseIcon from '@mui/icons-material/Close';

export default function Student({ payments, student, officeId, queueId }) {
    const [open, setOpen] = useState(false);
    const { post } = useForm();

    const submit = () => {
        post(route('queue.approve', queueId), {
            onSuccess: () => {
                setOpen(true);
                router.visit(route('queue.office', officeId));
            }
        });
    }

    const handleClose = (event, reason) => {
        if (reason === 'clickaway') {
            return;
        }

        setOpen(false);
    }

    const action = (
        <React.Fragment>
            <Button color="secondary" size="small" onClick={handleClose}>
                UNDO
            </Button>
            <IconButton
                size="small"
                aria-label="close"
                color="inherit"
                onClick={handleClose}
            >
            <CloseIcon fontSize="small" />
            </IconButton>
        </React.Fragment>
    );

    return (
        <AuthenticatedLayout
            header={
                <div className="flex justify-between items-center">
                    <h2 className="text-xl font-semibold leading-tight text-gray-800" >
                        {`${student.student_name}'s Payments`}
                    </h2 >

                    <Link href={route('queue.office', officeId)} >
                        <PrimaryButton >
                            Back
                        </PrimaryButton>
                    </Link>
                </div >
            }
        >
            <Head title={`${student.student_name} - Requirements`} />

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
                                        <th className="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" >
                                            Status
                                        </th >
                                    </tr >
                                </thead >
                                <tbody className="bg-white divide-y divide-gray-200" >
                                    {payments.length > 0 ? payments.map((requirement) => (
                                        <tr key={requirement.payment_id} >
                                            <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900" >
                                                {requirement.payment_name}
                                            </td >
                                            <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900" >
                                                {requirement.payment_type}
                                            </td >
                                            <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900" >
                                                {requirement.amount}
                                            </td >
                                            <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900" >
                                                {requirement.is_paid ? (
                                                    <span className="bg-green-500 text-white py-1 px-2 rounded-md" >
                                                        Paid
                                                    </span >
                                                ) : (
                                                    <span className="bg-red-500 text-white py-1 px-2 rounded-md" >
                                                        Unpaid
                                                    </span >
                                                )}
                                            </td >
                                        </tr >
                                    )) : (
                                        <p className="w-full mt-8 font-bold text-red-500 text-center" >
                                            No requirements found!
                                        </p >
                                    )}
                                </tbody >
                            </table >
                            <div className="mt-6" >
                                <Button
                                    variant="contained"
                                    color="success"
                                    onClick={submit}
                                >
                                    Approve
                                </Button >
                            </div >
                        </div >
                        <div >
                            <Snackbar
                                open={open}
                                autoHideDuration={6000}
                                onClose={handleClose}
                                message="Student Approved"
                                action={action}
                            />
                        </div >
                    </div >
                </div >
            </div >
        </AuthenticatedLayout >
    )
}
