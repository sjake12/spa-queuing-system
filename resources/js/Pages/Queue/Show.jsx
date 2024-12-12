import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.jsx";
import { Head } from "@inertiajs/react";
import { Box, Step, StepLabel, Stepper, Typography } from "@mui/material";

export default function Show({ signing_offices, status }){
    const officeNames = [
        'Librarian',
        'PSITS OFFICER',
        'CCSO OFFICER',
        'SBO OFFICER',
        'PROGRAM HEAD',
        'DEAN',
    ];

    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800" >
                    Your Queue
                </h2 >
            }
        >
            <Head title="Queue Updates" />

            <div className="py-12" >
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8" >
                    <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg" >
                        <div className="p-6 text-gray-900" >
                            <Box sx={{ width: '100%' }}>
                                <Stepper activeStep={status.signing_office_id - 1} alternativeLabel>
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
                            <div className="mt-20 flex justify-center">
                                <Typography className="mt-6" variant="h6">
                                    <span className="text-gray-500">
                                            {officeNames[status.signing_office_id - 1]} is processing your clearance
                                    </span>
                                </Typography>
                            </div>
                        </div >
                    </div >
                </div >
            </div >
        </AuthenticatedLayout >
    )
}
