import { usePage } from "@inertiajs/react";

export default function PermissionGate({ permission, children }) {
    const auth = usePage().props.auth;

    if(!auth.user?.permissions?.includes(permission)) {
        return null;
    }

    return children;
}
