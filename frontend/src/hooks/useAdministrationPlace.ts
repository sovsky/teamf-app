import {useMutation} from "@tanstack/react-query";
import {AxiosResponse} from "axios";
import {IVoivodeshipResponse} from "@/lib/api/getVoivodeships.ts";
import {useEffect} from "react";

interface IAdministrationPlace {
    mutationKey: string[];
    mutationFn: (id: string) => Promise<AxiosResponse<IVoivodeshipResponse, string>>;
    watchValue?: string;
}

export default function useAdministrationPlace({mutationKey, mutationFn, watchValue}: IAdministrationPlace) {
    const {mutate, data} = useMutation({mutationKey, mutationFn})

    useEffect(() => {
        if (!watchValue || watchValue === "0") return
        mutate(watchValue)
    }, [watchValue, mutate]);

    return {res: data}
}