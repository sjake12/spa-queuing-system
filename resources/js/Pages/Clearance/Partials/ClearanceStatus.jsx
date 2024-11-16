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
            <div className="bg-neutral-100 p-8 rounded-md shadow-md">
                <div className="flex flex-col gap-6">
                    {data.map((item, index) => (
                        <Link key={index} className="flex hover:bg-gray-300 py-2 px-6 rounded-md" href={route('clearance')}>
                            <h3 >{item.office} :</h3 >
                            <p >{item.status}</p >
                        </Link >
                    ))}
                </div >
            </div >
        </div>
    )
}
