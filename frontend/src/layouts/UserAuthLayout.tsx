import {Outlet} from 'react-router-dom'

const UserAuthLayout = () => {
    return (
        <div className='flex flex-col bg-main h-screen'>
            <div className='max-w-[1620px] mx-auto w-full py-10'>
                <Outlet/>
            </div>
        </div>
    )
}

export default UserAuthLayout