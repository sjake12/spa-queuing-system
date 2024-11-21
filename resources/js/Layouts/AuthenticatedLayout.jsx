import Dropdown from '@/Components/Dropdown';
import NavLink from '@/Components/NavLink';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink';
import { Link, usePage } from '@inertiajs/react';
import { useEffect, useState } from 'react';
import PermissionGate from "@/Pages/Auth/PermissionGate.jsx";

export default function AuthenticatedLayout({ header, children }) {
    const user = usePage().props.auth.user;
    const student = user.student;
    const [showingNavigationDropdown, setShowingNavigationDropdown] =
        useState(false);

    return (
        <div className="min-h-screen bg-gray-100">
            <nav className="border-b border-gray-100 bg-white">
                <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div className="flex h-16 justify-between">
                        <div className="flex" >
                            <div className="flex shrink-0 items-center" >
                                <Link href="/" >
                                    <img src="https://sksu.edu.ph/wp-content/uploads/2021/04/sksu1.png" alt="SKSU-logo"
                                         className="block h-9 w-auto" />
                                </Link >
                            </div >

                            <div className="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex" >
                                <NavLink
                                    href={route('dashboard')}
                                    active={route().current('dashboard')}
                                >
                                    Dashboard
                                </NavLink >
                            </div >

                            <div className="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex" >
                                <NavLink
                                    href={route('event')}
                                    active={route().current('event')}
                                >
                                    Events
                                </NavLink >
                            </div >

                            <div className="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex" >
                                <NavLink
                                    href={route('clearance')}
                                    active={route().current('clearance')}
                                >
                                    Clearance
                                </NavLink >
                            </div >

                            <div className="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex" >
                                <NavLink
                                    href={route('payments')}
                                    active={route().current('payments')}
                                >
                                    Payments
                                </NavLink >
                            </div >

                            <div className="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex" >
                                <NavLink
                                    href={route('queue')}
                                    active={route().current('queue')}
                                >
                                    Queue
                                </NavLink >
                            </div >
                        </div >

                        <div className="hidden sm:ms-6 sm:flex sm:items-center" >
                            <div className="relative ms-3" >
                                <Dropdown >
                                    <Dropdown.Trigger >
                                        <span className="inline-flex rounded-md" >
                                            <button
                                                type="button"
                                                className="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none"
                                            >
                                                {student.first_name} {student.last_name}

                                                <svg
                                                    className="-me-0.5 ms-2 h-4 w-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        fillRule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clipRule="evenodd"
                                                    />
                                                </svg >
                                            </button>
                                        </span>
                                    </Dropdown.Trigger>

                                    <Dropdown.Content>
                                        <PermissionGate permission="manage_users">
                                            <Dropdown.Link href={route('users')}>
                                                Manage Users
                                            </Dropdown.Link>
                                        </PermissionGate>
                                        <Dropdown.Link
                                            href={route('profile.edit')}
                                        >
                                            Profile
                                        </Dropdown.Link>
                                        <Dropdown.Link
                                            href={route('logout')}
                                            method="post"
                                            as="button"
                                        >
                                            Log Out
                                        </Dropdown.Link>
                                    </Dropdown.Content>
                                </Dropdown>
                            </div>
                        </div>

                        <div className="-me-2 flex items-center sm:hidden">
                            <button
                                onClick={() =>
                                    setShowingNavigationDropdown(
                                        (previousState) => !previousState,
                                    )
                                }
                                className="inline-flex items-center justify-center rounded-md p-2 text-gray-400 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-gray-500 focus:bg-gray-100 focus:text-gray-500 focus:outline-none"
                            >
                                <svg
                                    className="h-6 w-6"
                                    stroke="currentColor"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        className={
                                            !showingNavigationDropdown
                                                ? 'inline-flex'
                                                : 'hidden'
                                        }
                                        strokeLinecap="round"
                                        strokeLinejoin="round"
                                        strokeWidth="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                    <path
                                        className={
                                            showingNavigationDropdown
                                                ? 'inline-flex'
                                                : 'hidden'
                                        }
                                        strokeLinecap="round"
                                        strokeLinejoin="round"
                                        strokeWidth="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <div
                    className={
                        (showingNavigationDropdown ? 'block' : 'hidden') +
                        ' sm:hidden'
                    }
                >
                    <div className="space-y-1 pb-3 pt-2">
                        <ResponsiveNavLink
                            href={route('dashboard')}
                            active={route().current('dashboard')}
                        >
                            Dashboard
                        </ResponsiveNavLink>
                    </div>

                    <div className="border-t border-gray-200 pb-1 pt-4">
                        <div className="px-4">
                            <div className="text-base font-medium text-gray-800">
                                {student.first_name}
                            </div>
                            <div className="text-sm font-medium text-gray-500">
                                {student.last_name}
                            </div>
                        </div>

                        <div className="mt-3 space-y-1">
                            <PermissionGate permission="add_user">
                                <ResponsiveNavLink href={route('users.create')}>
                                    Add User
                                </ResponsiveNavLink>
                            </PermissionGate>
                            <ResponsiveNavLink href={route('profile.edit')}>
                                Profile
                            </ResponsiveNavLink>
                            <ResponsiveNavLink
                                method="post"
                                href={route('logout')}
                                as="button"
                            >
                                Log Out
                            </ResponsiveNavLink>
                        </div>
                    </div>
                </div>
            </nav>

            {header && (
                <header className="bg-white shadow">
                    <div className="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                        {header}
                    </div>
                </header>
            )}

            <main>{children}</main>
        </div>
    );
}
