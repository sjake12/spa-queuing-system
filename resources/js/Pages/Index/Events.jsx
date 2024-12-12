import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.jsx';
import { Head, Link, usePage } from '@inertiajs/react';
import PermissionGate from '@/Pages/Auth/PermissionGate.jsx';
import PrimaryButton from "@/Components/PrimaryButton.jsx";
import { Check, X } from 'lucide-react';

export default function Dashboard() {
    const { events } = usePage().props;
    const { role } = usePage().props.auth.user;

    return (
        <AuthenticatedLayout
            header={
                <div className="flex justify-between">
                    <h2 className="text-xl font-semibold leading-tight text-gray-800" >
                        Events
                    </h2 >

                    <PermissionGate permission="create_event" >
                        <Link href={route('event.create')} >
                            <PrimaryButton>
                                Create Event
                            </PrimaryButton >
                        </Link>
                    </PermissionGate >
                </div>
            }
        >
            <Head title="Events" />

            <div className="py-12" >
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8" >
                    <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg" >
                        <div className="p-6 text-gray-900" >
                            <table className="min-w-full divide-y divide-gray-200" >
                                <thead >
                                    <tr >
                                        <th className="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" >
                                            Event Name
                                        </th >
                                        <th className="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" >
                                            Date
                                        </th >
                                        <th className="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" >
                                            Office
                                        </th >
                                        <th className="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" >
                                            Required
                                        </th >
                                        { role === 'user' && (
                                            <th className="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" >
                                                Attended
                                            </th >
                                        )}
                                    </tr >
                                </thead >
                                <tbody className="bg-white divide-y divide-gray-200" >
                                {events.map((event) => (
                                        <tr key={event.id} >
                                            <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900" >
                                                {event.event_name}
                                            </td >
                                            <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900" >
                                                {event.event_date}
                                            </td >
                                            <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900" >
                                                {event.office}
                                            </td >
                                            <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900" >
                                                {event.required ? (
                                                    <Check
                                                        className="bg-green-500 text-white rounded-full"
                                                    />
                                                ) : (
                                                    <x
                                                        className="bg-red-500 text-white rounded-full"
                                                    />
                                                )}
                                            </td >
                                            { role === 'user' && (
                                                <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900" >
                                                    {event.has_attended ? (
                                                        <span
                                                            className="bg-green-500 text-white font-bold text-[10px] rounded-full py-1 px-2 cursor-default" >
                                                        Yes
                                                    </span >
                                                    ) : (
                                                        <span
                                                            className="bg-red-500 text-white font-bold text-[10px] rounded-full py-1 px-2 cursor-default" >
                                                            No
                                                        </span >
                                                    )
                                                    }
                                                </td >
                                            )}
                                        </tr >
                                ))}
                                </tbody >
                            </table >
                            {/*<div className="mt-4 flex gap-2" >*/}
                            {/*    {events.links.map((link, index) => {*/}
                            {/*        if (!link.url) {*/}
                            {/*            return (*/}
                            {/*                <span*/}
                            {/*                    key={index}*/}
                            {/*                    className="px-3 py-1 border rounded text-gray-400"*/}
                            {/*                    dangerouslySetInnerHTML={{ __html: link.label }}*/}
                            {/*                />*/}
                            {/*            );*/}
                            {/*        }*/}

                            {/*        return (*/}
                            {/*            <Link*/}
                            {/*                key={index}*/}
                            {/*                href={link.url}*/}
                            {/*                className={`px-3 py-1 border rounded ${*/}
                            {/*                    link.active ? 'bg-blue-500 text-white' : 'bg-white text-blue-500'*/}
                            {/*                }`}*/}
                            {/*                preserveScroll*/}
                            {/*                preserveState*/}
                            {/*                dangerouslySetInnerHTML={{ __html: link.label }}*/}
                            {/*            />*/}
                            {/*        );*/}
                            {/*    })}*/}
                            {/*</div >*/}
                        </div >
                    </div >
                </div >
            </div >
        </AuthenticatedLayout >
    );
}
