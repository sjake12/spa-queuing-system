import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.jsx";
import { Head, usePage } from "@inertiajs/react";
import { Box, Step, StepLabel, Stepper } from "@mui/material";

export default function Queue(){
    const { signing_offices } = usePage().props;
    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800" >
                    Queue
                </h2 >
            }
        >
            <Head title="Queue" />

            <div className="py-12" >
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8" >
                    <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg" >
                        <div className="p-6 text-gray-900" >
                            <Box sx={{ width: '100%' }}>
                                <Stepper activeStep={1} alternativeLabel>
                                    {signing_offices
                                        .filter(signingOffice => signingOffice.is_active && signingOffice.signing_sequence)
                                        .sort((a, b) => a.signing_sequence - b.signing_sequence)
                                        .map((signingOffice, index) => (
                                            <Step key={index}>
                                                <StepLabel>{signingOffice.office_name}</StepLabel>
                                            </Step>
                                        ))
                                    }
                                </Stepper>
                            </Box>
                        </div >
                    </div >
                </div >
            </div >
        </AuthenticatedLayout >
    )
}
