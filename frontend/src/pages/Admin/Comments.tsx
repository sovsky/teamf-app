import ReviewCard from '@/components/Admin/ReviewCard';
import { Button } from '@/components/ui/button';
import { images, peopleReviews, volunteers } from '@/constants';
import React, { useState } from 'react'
import { FaComments } from "react-icons/fa";
import { IoClose } from "react-icons/io5";

const Comments = () => {
    const [selectedReview, setSelectedReview] = useState(null);


    const handleReviewClick = (review) => {
        setSelectedReview(review);
    };

const handleCloseReview = () =>{
    setSelectedReview(null)
}


    return (
        <div className="flex flex-1 flex-col gap-4 px-10 py-5  ">
    <div className='flex items-center justify-between py-0.5'>
      <h2 className='text-xl font-semibold text-gray-800 flex items-center gap-x-1.5'>
        <FaComments className='h-6 w-6'/>
        Lista Komentarzy
        </h2>
  
    </div>
    
    <div className=' rounded-lg w-full h-full grid grid-cols-[2fr_3fr] gap-3'>
    <div className=' rounded-lg w-full h-full p-3 flex flex-col overflow-y-auto max-h-[80vh]'>

    
    {peopleReviews.map((review)=>{
      return(
   <div key={review.id} onClick={() => handleReviewClick(review)}>
    <ReviewCard review={review}/>
   </div>
      )
    })}
    </div>

{  selectedReview ?  (
    <div className='border-2 p-4 rounded-lg max-h-[80vh] overflow-y-auto bg-white'>
        <div className='flex justify-end'>
            <button 
            className='border p-0.5 rounded-md border-transparent hover:bg-gray-800 hover:text-white'
            onClick={handleCloseReview}>
                <IoClose className='w-5 h-5'/>
            </button>
        </div>
                    {selectedReview ? (
                       <div className='pt-2.5 px-6'>
                            <h3 className=' font-semibold mb-6 text-xl'>{selectedReview.volunteer.name}</h3>
                            <p className='text-gray-600 text-2xl'>{selectedReview.content}</p>
                            <p className='text-sm text-gray-500'>Ocena: {selectedReview.rating} / 10</p>
                            <p className='text-sm text-gray-500'>Wystawione przez: {selectedReview.author.name}</p>
                            <p className='text-sm text-gray-500'>{new Date(selectedReview.date).toLocaleDateString("pl-PL", {
                                year: "numeric",
                                month: "long",
                                day: "numeric"
                            })}</p>
                        </div>
                    ) : (
                        <p>Wybierz komentarz, aby zobaczyć szczegóły.</p>
                    )}
                </div>):(
                    <div className='w-1/2 h-auto mx-auto my-auto'>
                    <img 
                    className='object-contain'
                    src={images.nocontent} alt="" />
                    </div>)}





    </div>
    
      </div>
      )
}

export default Comments