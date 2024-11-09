import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, Link, usePage } from '@inertiajs/react';

export default function Dashboard() {
    const { events } = usePage().props;

    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800">
                    Events
                </h2>
            }
        >
            <Head title="Events" />

            <div className="py-12">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg">
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
                                            Required
                                        </th >
                                    </tr >
                                </thead >
                                <tbody className="bg-white divide-y divide-gray-200" >
                                    {events.data.map((event) => (
                                        <tr key={event.id} >
                                            <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900" >
                                                {event.event_name}
                                            </td >
                                            <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900" >
                                                {event.event_date}
                                            </td >
                                            <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900" >
                                                {event.required ? 'Yes' : 'No'}
                                            </td >
                                        </tr >
                                    ))}
                                </tbody >
                            </table >
                            <div className="mt-4 flex gap-2" >
                                {events.links.map((link, index) => {
                                    if (!link.url) {
                                        return (
                                            <span
                                                key={index}
                                                className="px-3 py-1 border rounded text-gray-400"
                                                dangerouslySetInnerHTML={{ __html: link.label }}
                                            />
                                        );
                                    }

                                    return (
                                        <Link
                                            key={index}
                                            href={link.url}
                                            className={`px-3 py-1 border rounded ${
                                                link.active ? 'bg-blue-500 text-white' : 'bg-white text-blue-500'
                                            }`}
                                            preserveScroll
                                            preserveState
                                            dangerouslySetInnerHTML={{ __html: link.label }}
                                        />
                                    );
                                })}
                            </div >
                        </div >
                    </div >
                </div >
            </div >
        </AuthenticatedLayout >
    );
}
