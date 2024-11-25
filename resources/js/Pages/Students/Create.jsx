import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.jsx";
import { Head, Link, useForm } from "@inertiajs/react";
import InputLabel from "@/Components/InputLabel.jsx";
import TextInput from "@/Components/TextInput.jsx";
import PrimaryButton from "@/Components/PrimaryButton.jsx";
import InputError from "@/Components/InputError.jsx";
export default function Create(){
    const {data, setData, post, processing, errors} = useForm({
        student_id: '',
        first_name: '',
        last_name: '',
        course: '',
    });

    const submit = (e) => {
        e.preventDefault();

        post(route('users.create'));
    };

    return (
        <AuthenticatedLayout
            header={
                <div className="flex justify-between" >
                    <h2 className="text-xl font-semibold leading-tight text-gray-800" >
                        Add Student
                    </h2 >

                    <Link href={route('users')} >
                        <PrimaryButton className="bg-red-600 hover:bg-red-500" >
                            Back
                        </PrimaryButton >
                    </Link >
                </div >
            }
        >
            <Head title="Add Student" />

            <div className="py-12" >
                <div className="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8" >
                    <div className="bg-white p-4 shadow sm:rounded-lg sm:p-8" >
                        <header >
                            <h2 className="text-lg font-medium text-gray-900" >
                                Student Information
                            </h2 >

                            <p className="mt-1 text-sm text-gray-600" >
                                Add student information for new student.
                            </p >
                        </header >

                        <form onSubmit={submit} className="mt-6 space-y-6" >
                            <div >
                                <InputLabel htmlFor="student_id" value="Student ID" />

                                <TextInput
                                    id="student_id"
                                    type="text"
                                    name="student_id"
                                    className="mt-1 block w-[50%]"
                                    onChange={(e) => setData('student_id', e.target.value)}
                                />

                                <InputError message={errors.student_id} />
                            </div >

                            <div >
                                <InputLabel htmlFor="first_name" value="First Name" />

                                <TextInput
                                    id="first_name"
                                    type="text"
                                    name="first_name"
                                    className="mt-1 block w-[50%]"
                                    onChange={(e) => setData('first_name', e.target.value)}
                                />

                                <InputError message={errors.first_name} />
                            </div >

                            <div >
                                <InputLabel htmlFor="last_name" value="Last Name" />

                                <TextInput
                                    id="last_name"
                                    type="text"
                                    name="last_name"
                                    className="mt-1 block w-[50%]"
                                    onChange={(e) => setData('last_name', e.target.value)}
                                />

                                <InputError message={errors.last_name} />
                            </div >

                            <div >
                                <InputLabel htmlFor="course" value="Course" />

                                <TextInput
                                    id="course"
                                    type="text"
                                    name="course"
                                    className="mt-1 block w-[50%]"
                                    onChange={(e) => setData('course', e.target.value)}
                                />

                                <InputError message={errors.course} />
                            </div >

                            <PrimaryButton disabled={processing} >Save</PrimaryButton >
                        </form >
                    </div >
                </div >
            </div >
        </AuthenticatedLayout >
        )
    }
