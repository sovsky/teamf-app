import heroBg from "../../public/wolontariat.jpg"
import hero7 from "../../public/hero7.svg"
import { LuHelpingHand } from "react-icons/lu";
import { PiUsers } from "react-icons/pi";
import { FaRegComments } from "react-icons/fa6";
import { IoMdArrowRoundBack } from "react-icons/io";
import { MdOutlineDashboard } from "react-icons/md";
import { IoIosMore } from "react-icons/io";

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
            url: "/admin/material-help",
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


  export const breadcrumbTranslations: Record<string, string> = {
    dashboard: "Pulpit",
    users: "Użytkownicy",
    volunteers: "Wolontariusze",
    peopleInNeed: "Potrzebujący",
    helpType: "Formy Pomocy",
    "material-help": "Pomoc Materialna",
    "medical-help": "Pomoc Medyczna",
   "psychological-help": "Pomoc Psychologiczna",
    comments: "Komentarze",
  };

  export const volunteers = [
    {
      firstName: "Jan",
      lastName: "Kowalski",
      nickname: "Janek",
      email: "jan.kowalski@example.com",
      age: 29,
      city: "Warszawa",
    },
    {
      firstName: "Anna",
      lastName: "Nowak",
      nickname: "Anka",
      email: "anna.nowak@example.com",
      age: 34,
      city: "Kraków",
    },
    {
      firstName: "Tomasz",
      lastName: "Wiśniewski",
      nickname: "Tom",
      email: "tomasz.wisniewski@example.com",
      age: 41,
      city: "Poznań",
    },
    {
      firstName: "Katarzyna",
      lastName: "Wójcik",
      nickname: "Kasia",
      email: "katarzyna.wojcik@example.com",
      age: 25,
      city: "Gdańsk",
    },
    {
      firstName: "Michał",
      lastName: "Zieliński",
      nickname: "Michu",
      email: "michal.zielinski@example.com",
      age: 30,
      city: "Wrocław",
    },
    {
      firstName: "Agnieszka",
      lastName: "Szymańska",
      nickname: "Agnes",
      email: "agnieszka.szymanska@example.com",
      age: 28,
      city: "Łódź",
    },
    {
      firstName: "Paweł",
      lastName: "Dąbrowski",
      nickname: "Pablo",
      email: "pawel.dabrowski@example.com",
      age: 36,
      city: "Szczecin",
    },
    {
      firstName: "Ewa",
      lastName: "Lewandowska",
      nickname: "Ewka",
      email: "ewa.lewandowska@example.com",
      age: 32,
      city: "Bydgoszcz",
    },
    {
      firstName: "Robert",
      lastName: "Kwiatkowski",
      nickname: "Rob",
      email: "robert.kwiatkowski@example.com",
      age: 40,
      city: "Lublin",
    },
    {
      firstName: "Zofia",
      lastName: "Jankowska",
      nickname: "Zośka",
      email: "zofia.jankowska@example.com",
      age: 27,
      city: "Katowice",
    },
  ];
  
  export const usersObjectHeaderTranslations: Record<string, string> = {
    firstName: "Imię",       // Tłumaczenie dla firstName
    lastName: "Nazwisko",    // Tłumaczenie dla lastName
    nickname: "Nick",         // Tłumaczenie dla nickname
    email: "Email",           // Tłumaczenie dla email
    age: "Wiek",              // Tłumaczenie dla age
    city: "Miasto",           // Tłumaczenie dla city
};