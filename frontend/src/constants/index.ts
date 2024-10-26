import heroBg from "../../public/wolontariat.jpg"
import hero7 from "../../public/hero7.svg"
import { LuHelpingHand } from "react-icons/lu";
import { PiUsers } from "react-icons/pi";
import { FaRegComments } from "react-icons/fa6";
import { IoMdArrowRoundBack } from "react-icons/io";
import { MdOutlineDashboard } from "react-icons/md";

export const navItems = [
    { label: "O nas", href: "#" },
    { label: "Jak to działa", href: "#how_it_works" },
    { label: "FAQ", href: "#" },
  
  ];

  export const images ={
    heroBg,
    hero7,
   
  }

  export const itemsVolunteer = [
    {
      "title": "Załóż konto",
      "description": "Wolontariusz wypełnia formularz rejestracyjny, podając swoje dane oraz lokalizację."
    },
    {
      "title": "Zaloguj się do panelu",
      "description": "Po zalogowaniu, wolontariusz ma dostęp do swojego panelu, gdzie widzi osoby potrzebujące pomocy w jego okolicy."
    },
    {
      "title": "Wybierz osobę do pomocy",
      "description": "Wolontariusz może przejrzeć profile osób potrzebujących i zdecydować, komu chce pomóc."
    },
    {
      "title": "Zaakceptuj osobę",
      "description": "Po akceptacji, osoba potrzebująca zostaje poinformowana, a wolontariusz może rozpocząć kontakt i pomoc."
    }
  ];
  
  export const itemsNeedy = [
    {
      "title": "Załóż konto",
      "description": "Osoba potrzebująca wypełnia formularz rejestracyjny, podając swoje dane i szczegóły dotyczące potrzeb.",
    },
    {
      "title": "Zaloguj się do panelu",
      "description": "Po zalogowaniu, osoba potrzebująca czeka na wolontariusza, który zdecyduje się jej pomóc."
    },
    {
      "title": "Otrzymaj akceptację",
      "description": "Gdy wolontariusz zaakceptuje jej prośbę, osoba potrzebująca otrzyma dane kontaktowe wolontariusza."
    },
    {
      "title": "Rozpocznij współpracę",
      "description": "Po akceptacji osoba potrzebująca może skontaktować się z wolontariuszem i otrzymać potrzebną pomoc."
    }
  ];
  

  export  const adminNavbarOptions = {
    user: {
      name: "shadcn",
      email: "m@example.com",
      avatar: "/avatars/shadcn.jpg",
    },
    navMain: [
     {
      title:"Dashboard",
      url:"/admin",
      icon: MdOutlineDashboard,
      isActive:true,
      
     },
      {
        title: "Użytkownicy",
        url: "#",
        icon: PiUsers,
        isActive: true,
        items: [
          {
            title: "Wolontariusze",
            url: "/admin/volunteers",
          },
          {
            title: "Potrzebujący",
            url: "/admin/peopleInNeed",
          },
      
        ],
      },
      {
        title: "Formy Pomocy",
        url: "helpType",
        icon: LuHelpingHand,
        items: [
          {
            title: "Materialna",
            url: "/admin/meterial-help",
          },
          {
            title: "Medyczna",
            url: "/admin/medical-help",
          },
          {
            title: "Psychologiczna",
            url: "/admin/psychological-help",
          },
        ],
      },
  
      {
        title: "Komentarze",
        url: "#",
        icon: FaRegComments,

      },
    ],
    navFooter:[
      {
        title:"Powrót",
        url:"/",
        icon: IoMdArrowRoundBack,
      }
    ]
  
  }