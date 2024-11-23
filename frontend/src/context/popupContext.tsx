import { createContext, ReactNode, useCallback, useState } from "react";


export interface IAuthData {
    isOpen: boolean;
    headerTitle: string;
    headerIcon?:React.ReactNode | null;
    headerDescription: string;
    children: React.ReactNode | null;
}


interface ProviderProps {
    popup: IAuthData; 
    openPopup: (data: Omit<IAuthData, 'isOpen'>) => void;
    closePopup:()=>void;
}

export const PopupContext = createContext<ProviderProps | null>(null);

export function PopupProvider({ children }: { children: ReactNode }) {
    // Stan popupu
    const [popup, setPopup] = useState<IAuthData>({
        isOpen: false,
        headerTitle: "",
        headerIcon:null,
        headerDescription: "",
        children: null,
    });

   
    const openPopup = useCallback(
        ({ headerTitle,headerIcon, headerDescription, children }: Omit<IAuthData, 'isOpen'>) => {
            setPopup({
                isOpen: true,
                headerTitle,
                headerIcon,
                headerDescription,
                children,
            });
        },
        []
    );

    const closePopup = useCallback(() => {
        setPopup({
           
            headerTitle:"",
            headerIcon:null,
            headerDescription:"",
            children:null,
            isOpen: false,
        });
      }, []);


    return (
        <PopupContext.Provider value={{ popup, openPopup,closePopup }}>
            {children}
        </PopupContext.Provider>
    );
}
