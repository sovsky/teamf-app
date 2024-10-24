import {StrictMode} from 'react'
import {createRoot} from 'react-dom/client'
import App from './App.tsx'
import './index.css'
import {BrowserRouter} from 'react-router-dom'
import {QueryClientProvider} from '@tanstack/react-query'
import queryClient from './config/queryClient.ts'
import {AuthProvider} from "@/context/authContext.tsx";

createRoot(document.getElementById('root')!).render(
    <StrictMode>
        <QueryClientProvider client={queryClient}>
            <BrowserRouter>
                <AuthProvider>
                    <App/>
                </AuthProvider>
            </BrowserRouter>
        </QueryClientProvider>

    </StrictMode>,
)
