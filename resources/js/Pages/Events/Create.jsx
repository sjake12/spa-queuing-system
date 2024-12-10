import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.jsx";
import { Head, Link, useForm } from "@inertiajs/react";
import PrimaryButton from "@/Components/PrimaryButton.jsx";
import InputLabel from "@/Components/InputLabel.jsx";
import TextInput from "@/Components/TextInput.jsx";
import Checkbox from "@/Components/Checkbox.jsx";
import InputError from "@/Components/InputError.jsx";

export default function Create(){
    const { data, setData, post, errors } = useForm({
        event_name: '',
        event_date: '',
        office: '',
        isRequired: true,
    });

    const submit = (e) => {
        e.preventDefault();

        post(route('event.create'));
    }

    return (
        <AuthenticatedLayout
            header={
                <div className="flex justify-between">
                    <h2 className="text-xl font-semibold leading-tight text-gray-800" >
                        Create Event
                    </h2 >

                    <Link href={route('event')} >
                        <PrimaryButton className="bg-red-600 hover:bg-red-500">
                            Back
                        </PrimaryButton>
                    </Link>
                </div>
            }
        >
            <Head title="Create Events" />

            <div className="py-12" >
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8" >
                    <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg" >
                        <div className="p-6 text-gray-900" >
                            <form onSubmit={submit}>
                                <div >
                                    <InputLabel htmlFor="event_name" value="Event Name" />

                                    <TextInput
                                        id="event_name"
                                        type="text"
                                        name="event_name"
                                        className="mt-1 block w-full"
                                        value={data.event_name}
                                        onChange={(e) => setData('event_name', e.target.value)}
                                    />

                                    <InputError message={errors.event_name} className="mt-2" />
                                </div >

                                <div className="mt-4">
                                    <InputLabel htmlFor="event_date" value="Event Date" />

                                    <TextInput
                                        id="event_date"
                                        type="date"
                                        name="event_date"
                                        className="mt-1 block w-full"
                                        value={data.event_date}
                                        onChange={(e) => setData('event_date', e.target.value)}
                                    />

                                    <InputError message={errors.event_date} className="mt-2" />
                                </div >

                                <div className="mt-4">
                                    <label className="flex items-center">
                                        <Checkbox
                                            name="isRequired"
                                            checked={data.isRequired}
                                            onChange={(e) => setData('isRequired', e.target.checked)}
                                        />

                                        <span className="ms-2 text-sm text-gray-600">
                                            Required
                                        </span>
                                    </label>
                                </div >

                                <div>
                                    <PrimaryButton
                                        className="mt-4"
                                        onClick={post}
                                    >
                                        Create Event
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
