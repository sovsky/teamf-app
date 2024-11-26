import React from 'react'
import MatchingUserCard from "@/components/UserPanel/MatchingUserCard.tsx";
import UserInfoCard from "@/components/UserPanel/UserInfoCard.tsx";
import UserAidInformationCard from "@/components/UserPanel/UserAidInformationCard.tsx";
import {useQuery} from "@tanstack/react-query";
import getMatchingUsers from "@/lib/api/getMatchingUsers.ts";
import useAuth from "@/hooks/useAuth.ts";
import getAidCategories from "@/lib/api/getAidCategories.ts";

const UserPanel: React.FC = () => {
    const {data: matchingUsersRes, status: matchingUsersStatus} = useQuery({
        queryKey: ['matchingUsers'],
        queryFn: getMatchingUsers
    })

    const {data: aidCategoriesRes, status: aidCategoriesStatus} = useQuery({
        queryKey: ["aidCategories"],
        queryFn: getAidCategories
    })

    const {user} = useAuth()

    return (
        <div className="flex flex-1 flex-col gap-4 p-4 pt-0 ">
            <div className="grid auto-rows-min gap-4 md:grid-cols-2">
                <UserInfoCard user={user}/>
                <UserAidInformationCard data={aidCategoriesRes} status={aidCategoriesStatus}/>
                <MatchingUserCard data={matchingUsersRes} status={matchingUsersStatus}/>
            </div>
        </div>
    )
}

export default UserPanel