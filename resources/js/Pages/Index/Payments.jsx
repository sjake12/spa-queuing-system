import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.jsx";
import { Head, Link, usePage } from "@inertiajs/react";
import PrimaryButton from "@/Components/PrimaryButton.jsx";
import PermissionGate from "@/Pages/Auth/PermissionGate.jsx";

export default function Payments(){
    const { payments } = usePage().props;

    return (
        <AuthenticatedLayout
            header={
                <div className="flex justify-between items-center">
                    <h2 className="text-xl font-semibold leading-tight text-gray-800" >
                        Payments
                    </h2 >

                    <PermissionGate permission={'manage_payments'} >
                        <Link href={route('payments.create')} >
                            <PrimaryButton>
                                Create Payments
                            </PrimaryButton>
                        </Link>
                    </PermissionGate>
                </div>
            }
        >
            <Head title="Payments" />

            <div className="py-12" >
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8" >
                    <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg" >
                        <div className="p-6 text-gray-900" >
                            <h2 className="font-semibold text-2xl mb-6">
                                Your Payments
                            </h2>
                            <table className="min-w-full divide-y divide-gray-200" >
                                <thead >
                                    <tr >
                                        <th className="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" >
                                            Amount
                                        </th >
                                        <th className="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" >
                                            Payment For
                                        </th >
                                        <th className="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" >
                                            Office
                                        </th >
                                        <th className="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" >
                                            Deadline
                                        </th >
                                        <th className="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" >
                                            Status
                                        </th >
                                        <th className="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" >
                                            Action
                                        </th >
                                    </tr >
                                </thead >
                                <tbody className="bg-white divide-y divide-gray-200" >
                                    {payments.map((payment) => (
                                        <tr key={payment.id} >
                                            <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900" >
                                                {payment.amount}
                                            </td >
                                            <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900" >
                                                {payment.for}
                                            </td >
                                            <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900" >
                                                {payment.office}
                                            </td >
                                            <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900" >
                                                {payment.deadline}
                                            </td >
                                            <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900" >
                                                {payment.status ? (
                                                    <span className="bg-green-500 text-white font-bold text-[10px] rounded-full py-1 px-2 cursor-default">
                                                        Paid
                                                    </span>
                                                ): (
                                                    <span className="bg-red-500 text-white font-bold text-[10px] rounded-full py-1 px-2 cursor-default">
                                                        Not Paid
                                                    </span>
                                                )}
                                            </td >
                                            <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900" >
                                                <Link
                                                    className="py-2 px-4 bg-blue-600 hover:bg-blue-500 text-white font-semibold rounded"
                                                    href={route('payments.show', payment.id)}
                                                >
                                                    Details
                                                </Link>
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
    );
}
