import { Link, usePage } from "@inertiajs/react";

export default function ClearanceStatus() {
    // fetch the clearance status from the server
    const { clearanceStatus } = usePage().props;

    const data = [
        {
            office: "Registrar",
            status: "Pending",
        },
        {
            office: "Accounting",
            status: "Pending",
        },
        {
            office: "Library",
            status: "Pending",
        },
        {
            office: "Dean",
            status: "Pending",
        },
    ]
    return (
        // map the clearance status here
        <div>
            <h2 className="font-semibold text-2xl mb-6">
                Clearance Status
            </h2>
            <div className="flex flex-col gap-4">
                {data.map((item, index) => (
                    <Link key={index}
                          className="flex py-6 px-6 border border-neutral-200 rounded-md justify-between shadow-sm hover:scale-[1.01] transition-transform"
                          href={route('clearance')}
                    >
                        <h3 className="font-bold text-lg">{item.office}</h3 >
                        <p >{item.status}</p >
                    </Link >
                ))}
            </div>
        </div>
    )
}
