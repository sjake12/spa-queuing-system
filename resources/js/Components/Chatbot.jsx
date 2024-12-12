import React, { useState, useRef, useEffect } from 'react';
import {
    Box,
    Fab,
    Drawer,
    TextField,
    IconButton,
    Typography,
    Paper,
    List,
    ListItem,
    ListItemText,
    Zoom
} from '@mui/material';
import {
    Chat as ChatIcon,
    Send as SendIcon,
    Close as CloseIcon
} from '@mui/icons-material';

const Chatbot = () => {
    const [isOpen, setIsOpen] = useState(false);
    const [messages, setMessages] = useState([
        { id: 1, text: "Hello! How can I help you today?", sender: 'bot' }
    ]);
    const [inputMessage, setInputMessage] = useState('');
    const messagesEndRef = useRef(null);
    const inputRef = useRef(null);

    // Scroll to bottom when messages change
    useEffect(() => {
        scrollToBottom();
    }, [messages]);

    // Autofocus input when drawer opens
    useEffect(() => {
        if (isOpen && inputRef.current) {
            inputRef.current.focus();
        }
    }, [isOpen]);

    const scrollToBottom = () => {
        messagesEndRef.current?.scrollIntoView({ behavior: "smooth" });
    };

    const handleToggleChatbot = () => {
        setIsOpen(!isOpen);
    };

    const handleSendMessage = () => {
        if (inputMessage.trim() === '') return;

        // Add user message
        const userMessage = {
            id: messages.length + 1,
            text: inputMessage,
            sender: 'user'
        };
        setMessages(prev => [...prev, userMessage]);

        // Simulate bot response (replace with actual API call)
        const botResponse = {
            id: messages.length + 2,
            text: `You said: ${inputMessage}. This is a placeholder response.`,
            sender: 'bot'
        };

        // Clear input and add bot response
        setInputMessage('');
        setTimeout(() => {
            setMessages(prev => [...prev, botResponse]);
        }, 500);
    };

    const handleKeyPress = (e) => {
        if (e.key === 'Enter') {
            handleSendMessage();
        }
    };

    return (
        <>
            {/* Floating Action Button / Chat Bubble */}
            <Zoom in={!isOpen}>
                <Fab
                    color="primary"
                    aria-label="chat"
                    onClick={handleToggleChatbot}
                    sx={{
                        position: 'fixed',
                        bottom: 16,
                        right: 16,
                        zIndex: (theme) => theme.zIndex.drawer + 1,
                        transition: 'all 0.3s ease',
                        ...(isOpen && {
                            transform: 'scale(0)',
                            opacity: 0
                        })
                    }}
                >
                    <ChatIcon />
                </Fab>
            </Zoom>

            {/* Chatbot Drawer */}
            <Drawer
                anchor="bottom"
                open={isOpen}
                onClose={handleToggleChatbot}
                PaperProps={{
                    sx: {
                        height: '500px',
                        maxHeight: '90vh',
                        borderTopLeftRadius: 16,
                        borderTopRightRadius: 16,
                        display: 'flex',
                        flexDirection: 'column',
                        borderBottom: 'none'
                    }
                }}
                sx={{
                    '& .MuiDrawer-paper': {
                        borderTopLeftRadius: 16,
                        borderTopRightRadius: 16,
                        boxShadow: '0 -4px 6px rgba(0,0,0,0.1)'
                    }
                }}
            >
                {/* Chatbot Header */}
                <Box
                    sx={{
                        display: 'flex',
                        alignItems: 'center',
                        p: 2,
                        borderBottom: 1,
                        borderColor: 'divider'
                    }}
                >
                    <Typography variant="h6" sx={{ flexGrow: 1 }}>
                        Chatbot
                    </Typography>
                    <IconButton onClick={handleToggleChatbot}>
                        <CloseIcon />
                    </IconButton>
                </Box>

                {/* Messages Container */}
                <Box
                    sx={{
                        flexGrow: 1,
                        overflowY: 'auto',
                        p: 2
                    }}
                >
                    <List>
                        {messages.map((msg) => (
                            <ListItem
                                key={msg.id}
                                sx={{
                                    justifyContent: msg.sender === 'user' ? 'flex-end' : 'flex-start',
                                    mb: 1
                                }}
                            >
                                <Paper
                                    elevation={1}
                                    sx={{
                                        p: 1.5,
                                        maxWidth: '75%',
                                        bgcolor: msg.sender === 'user' ? 'primary.light' : 'grey.200',
                                        color: msg.sender === 'user' ? 'primary.contrastText' : 'text.primary'
                                    }}
                                >
                                    <Typography variant="body2">
                                        {msg.text}
                                    </Typography>
                                </Paper>
                            </ListItem>
                        ))}
                        <div ref={messagesEndRef} />
                    </List>
                </Box>

                {/* Message Input */}
                <Box
                    sx={{
                        display: 'flex',
                        alignItems: 'center',
                        p: 2,
                        borderTop: 1,
                        borderColor: 'divider'
                    }}
                >
                    <TextField
                        ref={inputRef}
                        fullWidth
                        variant="outlined"
                        placeholder="Type a message..."
                        value={inputMessage}
                        onChange={(e) => setInputMessage(e.target.value)}
                        onKeyPress={handleKeyPress}
                        sx={{ mr: 1 }}
                    />
                    <IconButton
                        color="primary"
                        onClick={handleSendMessage}
                        disabled={inputMessage.trim() === ''}
                    >
                        <SendIcon />
                    </IconButton>
                </Box>
            </Drawer>
        </>
    );
};

export default Chatbot;
