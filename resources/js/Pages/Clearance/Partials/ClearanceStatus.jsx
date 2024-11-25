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
                {signingOffices
                    .filter(signingOffice => signingOffice.is_active && signingOffice.signing_sequence)
                    .map((signingOffice, index) => (
                        signingOffice.is_active &&
                        <Link key={index}
                              className="flex py-6 px-6 border border-neutral-200 rounded-md justify-between shadow-sm hover:scale-[1.01] transition-transform"
                              href={route('clearance.show', signingOffice.office_id)}
                        >
                            <h3 className="font-bold text-lg">{signingOffice.office_name}</h3 >
                            <p >{signingOffice.is_pending ? (
                                <span className="text-red-500">
                                    Pending
                                </span>
                            ) : (
                                <span className="text-green-500">
                                    Ready
                                </span>
                            )}</p >
                        </Link >
                    ))}
            </div>
        </div>
    )
}
