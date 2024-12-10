import React, { useState } from 'react';
import { Button, Modal, Typography, Box, CircularProgress } from "@mui/material";
import axios from "axios";
import { useForm } from "@inertiajs/react";

const GCashPayment = ({
                          amount,
                          description,
                          type,
                          paymentId
                      }) => {
    const [isProcessing, setIsProcessing] = useState(false);
    const [showModal, setShowModal] = useState(false);

    const { patch } = useForm();

    // const initiateGCashPayment = async () => {
    //     setIsProcessing(true);
    //     try {
    //         const response = await axios.post('/create-gcash-payment',  {
    //             amount: amount,
    //             description: 'Product Purchase',
    //             return_url: `${window.location.origin}/payment-return`
    //         });
    //
    //         // Redirect to PayMongo's payment page
    //         window.location.href = response.data.redirect_url;
    //     } catch (error) {
    //         console.error('Payment initiation failed', error);
    //         setIsProcessing(false);
    //     }
    // };

    const handleOpen = () => {
        setShowModal(true);
    }

    const handleClose = () => {
        setShowModal(false);
    }

    const style = {
        position: 'absolute',
        top: '50%',
        left: '50%',
        transform: 'translate(-50%, -50%)',
        width: 400,
        bgcolor: 'background.paper',
        border: '2px solid #000',
        boxShadow: 24,
        p: 4,
    };

    const submit = (e) => {
        e.preventDefault();
        setIsProcessing(true);
        patch(route('payments.pay', paymentId));
        setTimeout(() => {
            setIsProcessing(false);
            setShowModal(false);
        }, 1500)
    };

    return (
        <div >
            <Button onClick={handleOpen} variant="contained" >Pay through GCash</Button >
            <Modal
                open={showModal}
                onClose={handleClose}
                aria-labelledby="modal-modal-title"
                aria-describedby="modal-modal-description"
            >
                <form onSubmit={submit} >
                    <Box sx={style} >
                        <Typography id="modal-modal-title" variant="h6" component="h2" >
                            GCash Payment
                        </Typography >

                        <Typography id="form-amount" sx={{ mt: 2 }} >
                            Amount: {amount} pesos
                        </Typography >

                        <Typography id="form-description" sx={{ mt: 2 }} >
                            Description: {type.charAt(0).toUpperCase() + type.slice(1)} for {description}
                        </Typography >

                        <Typography id="form-mobile" sx={{ mt: 2 }} >
                            Mobile Number: <input type="text" />
                        </Typography >

                        <Button type="submit" variant="contained" sx={{ mt: 2 }} >
                            {isProcessing ? (
                                <CircularProgress color="inherit" size={25} />
                            ) : 'Submit'}
                        </Button >
                    </Box >
                </form >
            </Modal >
        </div >
    );
};

export default GCashPayment;
