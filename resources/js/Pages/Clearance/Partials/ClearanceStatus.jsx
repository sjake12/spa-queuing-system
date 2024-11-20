import { Link, usePage } from "@inertiajs/react";

export default function ClearanceStatus({signingOffices}) {
    // fetch the clearance status from the server
    const { clearanceStatus } = usePage().props;

    return (
        // map the clearance status here
        <div>
            <h2 className="font-semibold text-2xl mb-6">
                Clearance Status
            </h2>
            <div className="flex flex-col gap-4">
                {signingOffices.map((signingOffice, index) => (
                    signingOffice.is_Active &&
                    <Link key={index}
                         className="flex py-6 px-6 border border-neutral-200 rounded-md justify-between shadow-sm hover:scale-[1.01] transition-transform"
                         href={route('clearance')}
                    >
                        <h3 className="font-bold text-lg">{signingOffice.office_name}</h3 >
                        <p >{signingOffice.is_pending ? 'Pending' : 'Ready'}</p >
                    </Link >
                ))}
            </div>
        </div>
    )
}
