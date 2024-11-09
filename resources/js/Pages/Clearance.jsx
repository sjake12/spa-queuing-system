import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.jsx";

export default function Clearance() {
    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800">
                    Clearance
                </h2>
            }
        >
            <h1>Clearance</h1>
        </AuthenticatedLayout>
    )
}
