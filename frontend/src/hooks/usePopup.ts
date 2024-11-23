
import { PopupContext } from "@/context/popupContext";
import {useContext} from "react";

export default function usePopup() {
    const ctx = useContext(PopupContext)

    if (!ctx) {
        throw new Error("useAuth must be used within an AuthProvider")
    }

    return ctx
}
