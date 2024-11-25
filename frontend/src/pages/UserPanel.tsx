import React from 'react'
import MatchingUserCard from "@/components/UserPanel/MatchingUserCard.tsx";
import UserInfoCard from "@/components/UserPanel/UserInfoCard.tsx";
import UserAidInformationCard from "@/components/UserPanel/UserAidInformationCard.tsx";
import {useQuery} from "@tanstack/react-query";
import getMatchingUsers from "@/lib/api/getMatchingUsers.ts";

const UserPanel: React.FC = () => {

    const {data, status} = useQuery({queryKey: ['matchingUsers'], queryFn: getMatchingUsers})

    return (
        <div className="flex flex-1 flex-col gap-4 p-4 pt-0 ">
            <div className="grid auto-rows-min gap-4 md:grid-cols-2">
                <UserInfoCard/>
                <UserAidInformationCard/>
                <MatchingUserCard data={data} status={status}/>
            </div>
        </div>
    )
}

export default UserPanel