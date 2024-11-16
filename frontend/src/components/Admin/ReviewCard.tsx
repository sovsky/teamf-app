import React from 'react'


interface IReview{
    id: number;
    content: string;
    author: {
      name: string;
      contactInfo: string;
    };
    volunteer: {
      name: string;
      volunteerId: number;
    };
    date: string;
    rating: number; // Zakres 1-10
    status: 'pending' | 'approved' | 'rejected' | 'spam';
}


interface IReviewCardProps {
review:IReview
  }


const ReviewCard:React.FC<IReviewCardProps> = ({review}) => {
  return (
    <div className="bg-white shadow-lg rounded-lg p-6 mb-3 border border-gray-200 flex flex-col gap-4">

    <div className="flex items-center justify-between">
      <div>
        <h3 className="text-xl font-semibold text-gray-800">
          {review.volunteer.name}
        </h3>
        <span className="text-sm text-gray-500">Ocena: {review.rating} / 10</span>
      </div>
      <span
        className={`text-xs font-semibold px-2 py-1 rounded-full ${
          review.status === "approved"
            ? "bg-green-100 text-green-700"
            : review.status === "pending"
            ? "bg-yellow-100 text-yellow-700"
            : review.status === "rejected"
            ? "bg-red-100 text-red-700"
            : "bg-gray-100 text-gray-700"
        }`}
      >
        {review.status.charAt(0).toUpperCase() + review.status.slice(1)}
      </span>
    </div>

    {/* REVIEW CONTENT  */}
    <p className="text-gray-600">{review.content}</p>

    {/* AUTHOR & DATE INFO*/}
    <div className="flex justify-between items-center">
      <div>
        <p className="text-sm font-medium text-gray-700">
          Wystawione przez: {review.author.name}
        </p>
        <p className="text-sm text-gray-500">{review.author.contactInfo}</p>
      </div>
      <span className="text-sm text-gray-400">
        {new Date(review.date).toLocaleDateString("pl-PL", {
          year: "numeric",
          month: "long",
          day: "numeric"
        })}
      </span>
    </div>
  </div>
  )
}

export default ReviewCard;