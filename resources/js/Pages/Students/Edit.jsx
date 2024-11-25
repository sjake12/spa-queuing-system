import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.jsx";
import { Head, Link, useForm, usePage } from "@inertiajs/react";
import InputLabel from "@/Components/InputLabel.jsx";
import TextInput from "@/Components/TextInput.jsx";
import PrimaryButton from "@/Components/PrimaryButton.jsx";
import InputError from "@/Components/InputError.jsx";
import SecondaryButton from "@/Components/SecondaryButton.jsx";
export default function Create(){
    const student = usePage().props.student;

    const {data, setData, patch, processing, errors} = useForm({
        student_id: student.student_id,
        first_name: student.first_name,
        last_name: student.last_name,
        course: student.course,
    });

    const submit = (e) => {
        e.preventDefault();

        patch(route('users.update', student.student_id));
    };

    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800" >
                    Edit Student
                </h2 >
            }
        >
            <Head title="Edit Student" />

            <div className="py-12" >
                <div className="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8" >
                    <div className="bg-white p-4 shadow sm:rounded-lg sm:p-8" >
                        <header >
                            <h2 className="text-lg font-medium text-gray-900" >
                                Student Information
                            </h2 >

                            <p className="mt-1 text-sm text-gray-600" >
                                Edit student information.
                            </p >
                        </header >

                        <form onSubmit={submit} className="mt-6 space-y-6">
                            <div>
                                <InputLabel htmlFor="student_id" value="Student ID" />

                                <TextInput
                                    id="student_id"
                                    type="text"
                                    name="student_id"
                                    className="mt-1 block w-[50%]"
                                    value={data.student_id}
                                    onChange={(e) => setData('student_id', e.target.value)}
                                />

                                <InputError message={errors.student_id} />
                            </div>

                            <div>
                                <InputLabel htmlFor="first_name" value="First Name" />

                                <TextInput
                                    id="first_name"
                                    type="text"
                                    name="first_name"
                                    className="mt-1 block w-[50%]"
                                    value={data.first_name}
                                    onChange={(e) => setData('first_name', e.target.value)}
                                />

                                <InputError message={errors.first_name} />
                            </div>

                            <div>
                                <InputLabel htmlFor="last_name" value="Last Name" />

                                <TextInput
                                    id="last_name"
                                    type="text"
                                    name="last_name"
                                    className="mt-1 block w-[50%]"
                                    value={data.last_name}
                                    onChange={(e) => setData('last_name', e.target.value)}
                                />

                                <InputError message={errors.last_name} />
                            </div>

                            <div>
                                <InputLabel htmlFor="course" value="Course" />

                                <TextInput
                                    id="course"
                                    type="text"
                                    name="course"
                                    className="mt-1 block w-[50%]"
                                    value={data.course}
                                    onChange={(e) => setData('course', e.target.value)}
                                />

                                <InputError message={errors.course} />
                            </div>

                            <PrimaryButton disabled={processing}>Update</PrimaryButton>
                            <Link
                                href={route('users')}
                                className="ml-4"
                            >
                                <SecondaryButton>Cancel</SecondaryButton>
                            </Link>
                        </form>
                    </div >
                </div >
            </div >
        </AuthenticatedLayout >
    )
}
