import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.jsx";
import { Link, usePage } from "@inertiajs/react";
import PrimaryButton from "@/Components/PrimaryButton.jsx";
import GCashPayment from "@/Components/GCashPayment.jsx";
import { Button } from "@mui/material";

export default function Show(){
    const { payment } = usePage().props;

    return (
        <AuthenticatedLayout
            header={
                <div className="flex justify-between items-center">
                    <h2 className="text-xl font-semibold leading-tight text-gray-800" >
                        Payment Details
                    </h2 >

                    <Link href={route('payments')} >
                        <PrimaryButton className="bg-red-500">
                            Back
                        </PrimaryButton>
                    </Link>
                </div>
            }
        >
            <div className="py-12" >
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8" >
                    <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg" >
                        <div className="p-6 text-gray-900" >
                            <h2 className="font-semibold text-2xl mb-6">
                                Payment Details
                            </h2>
                            <div>
                                <p>Amount : {payment.amount}</p>
                                <p>For : {payment.for}</p>
                                <p>Office : {payment.office}</p>
                                <p>Deadline : {payment.deadline === null ? 'NA' : payment.deadline}</p>
                                <p>Type : {payment.type}</p>
                            </div>
                            <div className="mt-6">
                                <strong className="block mb-2">Pay through Gcash:</strong>
                                { payment.status ? (
                                    <Button
                                        variant="contained"
                                        disabled={true}
                                    >
                                        Paid
                                    </Button>
                                ) :
                                <GCashPayment
                                    amount={payment.amount}
                                    description={payment.for}
                                    type={payment.type}
                                    paymentId={payment.payment_id}
                                />}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
