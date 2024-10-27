import heroBg from "../../public/wolontariat.jpg"
import hero7 from "../../public/hero7.svg"
import nocontent from "../../public/no-content-placeholder.png";
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
    nocontent,
   
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
      title:"Pulpit",
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
        url: "/admin/comments",
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

export const peopleReviews = [
  {
    id: 1,
    content: "Wolontariusz był bardzo pomocny i zaangażowany. Jestem mu bardzo wdzięczny!",
    author: {
      name: "Maria Nowak",
      contactInfo: "maria.nowak@example.com"
    },
    volunteer: {
      name: "Jan Kowalski",
      volunteerId: 201
    },
    date: "2023-10-01T14:25:00Z",
    rating: 9,
    status: "approved"
  },
  {
    id: 2,
    content: "Wolontariusz spóźnił się o godzinę, ale mimo to bardzo mi pomógł.",
    author: {
      name: "Piotr Zając",
      contactInfo: "piotr.zajac@example.com"
    },
    volunteer: {
      name: "Anna Nowak",
      volunteerId: 202
    },
    date: "2023-10-02T09:15:00Z",
    rating: 7,
    status: "pending"
  },
  {
    id: 3,
    content: "Bardzo polecam tego wolontariusza! Sympatyczny i pełen zrozumienia.",
    author: {
      name: "Karolina Wiśniewska",
      contactInfo: "karolina.wisniewska@example.com"
    },
    volunteer: {
      name: "Piotr Zieliński",
      volunteerId: 203
    },
    date: "2023-10-03T16:42:00Z",
    rating: 10,
    status: "approved"
  },
  {
    id: 4,
    content: "Wolontariusz był miły, ale niestety nie do końca znał się na zadaniu.",
    author: {
      name: "Tomasz Mazur",
      contactInfo: "tomasz.mazur@example.com"
    },
    volunteer: {
      name: "Magdalena Kowal",
      volunteerId: 204
    },
    date: "2023-10-04T12:00:00Z",
    rating: 6,
    status: "approved"
  },
  {
    id: 5,
    content: "Wspaniała pomoc! Wolontariusz zrobił więcej, niż się spodziewałem.",
    author: {
      name: "Joanna Piotrowska",
      contactInfo: "joanna.piotrowska@example.com"
    },
    volunteer: {
      name: "Krzysztof Wiśniewski",
      volunteerId: 205
    },
    date: "2023-10-05T11:25:00Z",
    rating: 10,
    status: "approved"
  },
  {
    id: 6,
    content: "Wolontariusz próbował pomóc, ale miał problem z czasem.",
    author: {
      name: "Paweł Wróbel",
      contactInfo: "pawel.wrobel@example.com"
    },
    volunteer: {
      name: "Agnieszka Malinowska",
      volunteerId: 206
    },
    date: "2023-10-06T10:10:00Z",
    rating: 5,
    status: "rejected"
  },
  {
    id: 7,
    content: "Pomoc szybka i skuteczna, polecam!",
    author: {
      name: "Lena Kwiatkowska",
      contactInfo: "lena.kwiatkowska@example.com"
    },
    volunteer: {
      name: "Maciej Sobczak",
      volunteerId: 207
    },
    date: "2023-10-07T09:00:00Z",
    rating: 8,
    status: "approved"
  },
  {
    id: 8,
    content: "Niestety wolontariusz był mało zaangażowany.",
    author: {
      name: "Filip Jasiński",
      contactInfo: "filip.jasinski@example.com"
    },
    volunteer: {
      name: "Zuzanna Lewandowska",
      volunteerId: 208
    },
    date: "2023-10-08T14:00:00Z",
    rating: 4,
    status: "spam"
  },
  {
    id: 9,
    content: "Świetna organizacja i profesjonalizm, dziękuję!",
    author: {
      name: "Magdalena Nowicka",
      contactInfo: "magdalena.nowicka@example.com"
    },
    volunteer: {
      name: "Adam Kaczmarek",
      volunteerId: 209
    },
    date: "2023-10-09T15:30:00Z",
    rating: 9,
    status: "approved"
  },
  {
    id: 10,
    content: "Wolontariusz wykonał wszystko, co było wymagane. Polecam!",
    author: {
      name: "Kamil Głowacki",
      contactInfo: "kamil.glowacki@example.com"
    },
    volunteer: {
      name: "Oliwia Walczak",
      volunteerId: 210
    },
    date: "2023-10-10T08:20:00Z",
    rating: 8,
    status: "approved"
  },
  {
    id: 11,
    content: "Bardzo pomocny, szybko reaguje na potrzeby.",
    author: {
      name: "Alicja Król",
      contactInfo: "alicja.krol@example.com"
    },
    volunteer: {
      name: "Paweł Adamczyk",
      volunteerId: 211
    },
    date: "2023-10-11T19:30:00Z",
    rating: 10,
    status: "approved"
  },
  {
    id: 12,
    content: "Nie polecam, spóźniony i nieprzygotowany.",
    author: {
      name: "Michał Lis",
      contactInfo: "michal.lis@example.com"
    },
    volunteer: {
      name: "Ewa Borkowska",
      volunteerId: 212
    },
    date: "2023-10-12T11:45:00Z",
    rating: 3,
    status: "rejected"
  }
];
