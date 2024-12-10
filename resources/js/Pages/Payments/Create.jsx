import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.jsx";
import { Head, Link, useForm } from "@inertiajs/react";
import InputLabel from "@/Components/InputLabel.jsx";
import TextInput from "@/Components/TextInput.jsx";
import InputError from "@/Components/InputError.jsx";
import Checkbox from "@/Components/Checkbox.jsx";
import PrimaryButton from "@/Components/PrimaryButton.jsx";

export default function Create(){
    const { data, setData, post, errors } = useForm({
        'amount': '',
        'for': '',
        'deadline': '',
    });

    const submit = (e) => {
        e.preventDefault();

        post(route('payments.store'));
    }

    return (
        <AuthenticatedLayout
            header={
                <div className="flex justify-between items-center">
                    <h2 className="text-xl font-semibold leading-tight text-gray-800" >
                        Create Payment
                    </h2 >

                    <Link href={route('payments')} >
                        <PrimaryButton className="bg-red-600 hover:bg-red-500">
                            Back
                        </PrimaryButton >
                    </Link >
                </div >
            }
        >
            <Head title="Create Payment" />

            <div className="py-12" >
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8" >
                    <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg" >
                        <div className="p-6 text-gray-900" >
                            <form onSubmit={submit}>
                                <div >
                                    <InputLabel htmlFor="amount" value="Amount" />

                                    <TextInput
                                        id="amount"
                                        type="text"
                                        name="amount"
                                        className="mt-1 block w-full"
                                        value={data.amount}
                                        onChange={(e) => setData('amount', e.target.value)}
                                    />

                                    <InputError message={errors.amount} className="mt-2" />
                                </div >

                                <div className="mt-4">
                                    <InputLabel htmlFor="for" value="Payment For" />

                                    <TextInput
                                        id="for"
                                        type="text"
                                        name="for"
                                        className="mt-1 block w-full"
                                        value={data.for}
                                        onChange={(e) => setData('for', e.target.value)}
                                    />

                                    <InputError message={errors.for} className="mt-2" />
                                </div >

                                <div className="mt-4">
                                    <InputLabel htmlFor="deadline" value="Deadline" />

                                    <TextInput
                                        id="deadline"
                                        type="date"
                                        name="deadline"
                                        className="mt-1 block w-full"
                                        value={data.deadline}
                                        onChange={(e) => setData('deadline', e.target.value)}
                                    />

                                    <InputError message={errors.deadline} className="mt-2" />
                                </div >

                                <div>
                                    <PrimaryButton
                                        className="mt-6"
                                        onClick={post}
                                    >
                                        Create payment
                                    </PrimaryButton>
                                </div>
                            </form >
                        </div >
                    </div >
                </div >
            </div >
        </AuthenticatedLayout >
    )
}
