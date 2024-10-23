import Page from '@/layouts/AdminLayout'
import { AppSidebar } from '@/components/NavigationSidebar'
import Navbar from '@/components/Navbar'
import React from 'react'
import { Outlet } from 'react-router-dom'

const UserAuthLayout = () => {
  return (
    <div className='flex flex-col bg-main '
    >
  
      <div className='bg-neutral-50 max-w-[1620px] mx-auto w-full '>
        <Outlet/>
      </div>
    </div>
  )
}

export default UserAuthLayout