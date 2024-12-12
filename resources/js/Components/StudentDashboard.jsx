export default function StudentDashboard({ queueUpdate, paymentStatus, eventAttendance }) {
    const { signingOffice, activeOffices } = queueUpdate;

    return (
        <div className="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3" >
            <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg" >
                <div className="p-6 text-gray-900 flex justify-between items-center" >
                    <div className="flex flex-col" >
                        <h2 className="font-semibold text-xl mb-2" >Queue Updates</h2 >
                        <p >{`Current Progress: ${signingOffice.name}`}</p >
                        <p >{`${signingOffice.id} / ${activeOffices} Offices Completed`}</p >
                    </div >
                    <div >
                        <svg fill="#000000" xmlns="http://www.w3.org/2000/svg"
                             width="75px" height="75px" viewBox="0 0 100 100"
                             enableBackground="new 0 0 100 100" xmlSpace="preserve" >
                            <path d="M67.6,20.1c-2.9,0-5.4,2.1-6.4,5c3.8,1.7,6.7,5.4,7.7,9.9c3.1-0.7,5.4-3.7,5.4-7.3
                                            C74.3,23.4,71.3,20.1,67.6,20.1z" />
                            <path d="M73.8,37.9c-1.3,1.2-2.9,2-4.7,2.3c-0.3,2.7-1.3,5.2-2.8,7.2h11.1c1.4,0,2.5-1.1,2.5-2.5v-1.2
                                            C79.9,41,76.9,39.3,73.8,37.9z" />
                            <path d="M63.2,50c-2,1.8-4.5,2.9-7.2,2.9c-0.2,3.1-1.1,5.9-2.5,8.3h14c1.6,0,3-1.3,3-3V57
                                            C70.4,53.7,66.8,51.7,63.2,50z" />
                            <path d="M50.3,65.2c-2.8,2.8-6.6,4.4-10.6,4.4c-4.1,0-7.9-1.7-10.7-4.6C24.4,67.2,20,70,20,74.1V76
                                            c0,2.2,1.8,3.9,3.9,3.9h31.3c2.2,0,3.9-1.8,3.9-3.9v-1.8C59.1,70,54.9,67.3,50.3,65.2z" />
                            <ellipse cx="39.6" cy="51.6" rx="10.7" ry="11.8" />
                            <path d="M55.7,29.5c-3.7,0-6.8,2.7-7.7,6.5c3.7,2.4,6.4,6.5,7.5,11.2c0.1,0,0.1,0,0.2,0c4.4,0,8-4,8-8.9
                                            C63.8,33.5,60.2,29.5,55.7,29.5z" />
                        </svg >
                    </div >
                </div >
            </div >
            <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg" >
                <div className="p-6 text-gray-900 flex justify-between items-center" >
                    <div >
                        <h2 className="font-semibold text-xl mb-2" >Payments Status</h2 >
                        <p >{`You paid: ${paymentStatus.numberOfPaidPayments} out of ${paymentStatus.numberOfPayments}`}</p >
                    </div >
                    <div >
                        <svg fill="#010002" height="75px" width="75px" version="1.1" id="Capa_1"
                             xmlns="http://www.w3.org/2000/svg"
                             xmlnsXlink="http://www.w3.org/1999/xlink"
                             viewBox="0 0 502.685 502.685" xmlSpace="preserve" >
                            <g >
                                <g >
                                    <path d="M482.797,276.924c4.53-5.824,6.73-13.331,4.724-20.988L428.05,30.521
                                            c-3.451-13.029-16.847-20.837-29.854-17.386L18.184,113.331C5.22,116.761-2.61,130.2,0.798,143.207L60.269,368.6
                                            c3.408,13.007,16.868,20.816,29.876,17.408l134.278-35.419v75.476c0,42.214,69.954,64.303,139.11,64.303
                                            c69.113,0,139.153-22.089,139.153-64.302V311.61C502.685,297.869,495.157,286.307,482.797,276.924z M439.763,199.226l6.212,23.469
                                            l-75.541,19.953l-6.169-23.512L439.763,199.226z M395.931,50.733l11.799,44.695l-118.014,31.148l-11.799-44.695L395.931,50.733z
                                             M342.975,224.744l6.04,22.951c-27.934,1.251-55.113,6.126-76.943,14.452l-4.616-17.429L342.975,224.744z M79.984,319.224
                                            l-6.169-23.426l75.519-19.975l6.212,23.555L79.984,319.224z M170.625,270.237l75.476-19.953l5.716,21.506
                                            c-1.834,1.122-3.559,2.286-5.242,3.473l-69.781,18.421L170.625,270.237z M477.491,424.209c0,24.612-50.993,44.544-113.958,44.544
                                            c-62.9,0-113.937-19.953-113.937-44.544v-27.718c0-0.928,0.539-1.769,0.69-2.653c3.602,23.34,52.654,41.847,113.247,41.847
                                            c60.614,0,109.687-18.508,113.268-41.847c0.151,0.884,0.69,1.726,0.69,2.653V424.209z M477.491,369.678
                                            c0,24.591-50.993,44.522-113.958,44.522c-62.9,0-113.937-19.931-113.937-44.522V341.96c0-0.906,0.539-1.769,0.69-2.653
                                            c3.602,23.318,52.654,41.869,113.247,41.869c60.614,0,109.687-18.551,113.268-41.869c0.151,0.884,0.69,1.747,0.69,2.653V369.678z
                                             M363.532,356.11c-62.9,0-113.937-19.931-113.937-44.501c0-24.569,51.036-44.5,113.937-44.5c62.965,0,113.958,19.931,113.958,44.5
                                            C477.491,336.179,426.497,356.11,363.532,356.11z" />
                                </g >
                                <g ></g >
                                <g ></g >
                                <g ></g >
                                <g ></g >
                                <g ></g >
                                <g ></g >
                                <g ></g >
                                <g ></g >
                                <g ></g >
                                <g ></g >
                                <g ></g >
                                <g ></g >
                                <g ></g >
                                <g ></g >
                                <g ></g >
                            </g >
                        </svg >
                    </div >
                </div >
            </div >
            <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg" >
                <div className="p-6 text-gray-900 flex justify-between items-center" >
                    <div >
                        <h2 className="font-semibold text-xl mb-2" >Events Status</h2 >
                        <p>{`You missed: ${eventAttendance.numberOfEvents - eventAttendance.numberOfAttendedEvents} events`}</p >
                        <p>{`You attended: ${eventAttendance.numberOfAttendedEvents} events`}</p>
                    </div >
                    <div >
                        <svg fill="#000000" version="1.1" id="Layer_1"
                             width="75px" height="75px"
                             xmlns="http://www.w3.org/2000/svg"
                             xmlnsXlink="http://www.w3.org/1999/xlink"
                             viewBox="0 0 24 24" xmlSpace="preserve" >
                            <g >
                                <path
                                    d="M20,7.4v10.5c0,1.7-1.3,3-3,3H5.9c0,1.1,0.9,2,2,2H18c2.2,0,4-1.8,4-4V9.4C22,8.3,21.1,7.4,20,7.4z" />
                                <g >
                                    <path d="M5,1.1v2H4c-1.1,0-2,0.9-2,2v12c0,1.1,0.9,2,2,2h12.2c1.1,0,2-0.9,2-2v-12c0-1.1-0.9-2-2-2h-1v-2h-2v2H7v-2
                                                        C7,1.1,5,1.1,5,1.1z M4,8.1h12.2v9H4V8.1z" />
                                    <path
                                        d="M13.7,16.3l-2.4-1.4L9,16.3l0.6-2.7l-2.1-1.8l2.8-0.2L11.4,9l1.1,2.5l2.8,0.3l-2.1,1.8L13.7,16.3z" />
                                </g >
                            </g >
                            <rect className="st0" width="24" height="24" fill="none" />
                        </svg >
                    </div >
                </div >
            </div >
        </div >
    );
}
