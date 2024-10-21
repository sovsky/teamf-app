import React from 'react'
import { FaQuestion } from "react-icons/fa";
import { AccordionBox } from './AccordionBox';



const faqList = [
    {
      header: "Jak mogę się zarejestrować jako wolontariusz?",
      content: "Aby zarejestrować się jako wolontariusz, odwiedź stronę rejestracji, wybierz opcję 'Zarejestruj się jako wolontariusz', a następnie wypełnij formularz rejestracyjny."
    },
    {
      header: "Jak mogę się zarejestrować jako osoba potrzebująca pomocy?",
      content: "Podobnie jak w przypadku wolontariuszy, wybierz opcję 'Zarejestruj się jako osoba potrzebująca pomocy' i wypełnij formularz rejestracyjny."
    },
    {
      header: "Czy mogę zarejestrować się w obu rolach?",
      content: "Nie, w danej chwili można zarejestrować się tylko w jednej roli: jako wolontariusz lub osoba potrzebująca pomocy."
    },
    {
      header: "Jakie informacje muszę podać przy rejestracji?",
      content: "Będziesz musiał podać podstawowe informacje, takie jak imię, nazwisko, adres e-mail oraz, jeśli jesteś wolontariuszem, dodatkowe informacje o umiejętnościach lub dostępności."
    },
    {
      header: "Jak mogę zalogować się do swojego konta?",
      content: "Aby zalogować się, wprowadź swój adres e-mail oraz hasło na stronie logowania, a następnie kliknij przycisk 'Zaloguj się'."
    },
    {
      header: "Jak mogę znaleźć osoby potrzebujące pomocy w mojej okolicy?",
      content: "Po zalogowaniu się na konto wolontariusza, na panelu głównym zobaczysz listę osób potrzebujących pomocy w Twojej okolicy."
    },
    {
      header: "Co się stanie, gdy zaakceptuję osobę potrzebującą pomoc?",
      content: "Gdy zaakceptujesz osobę potrzebującą pomoc, otrzymasz możliwość skontaktowania się z nią. Osoba potrzebująca także będzie miała dostęp do Twoich danych kontaktowych po zalogowaniu."
    },
    {
      header: "Czy mogę edytować swoje dane po rejestracji?",
      content: "Tak, możesz edytować swoje dane osobowe w sekcji 'Moje Konto' po zalogowaniu."
    },
    {
      header: "Czy aplikacja jest darmowa?",
      content: "Tak, korzystanie z aplikacji jest całkowicie darmowe zarówno dla wolontariuszy, jak i osób potrzebujących pomocy."
    },
    {
      header: "Jak mogę skontaktować się z obsługą klienta?",
      content: "W przypadku pytań lub problemów skontaktuj się z nami za pomocą formularza kontaktowego w aplikacji lub napisz na nasz adres e-mail."
    },
    {
      header: "Jakie są zasady korzystania z aplikacji?",
      content: "Zasady korzystania z aplikacji znajdziesz w sekcji 'Regulamin' dostępnej na naszej stronie głównej."
    }
  ];





const FaqSection:React.FC = () => {
  return (
    <div className='py-16 px-8 lg:px-1'>
             <h2 className='text-4xl flex items-center gap-0.5 justify-center font-semibold mb-20'>
        <FaQuestion className='text-purple-950'/>
        Najczęściej zadawane pytania</h2>
    


{
    faqList?.map((item)=>{
return(
    <AccordionBox item={item}/>
)
    })
}

       

   
    </div>
  )
}

export default FaqSection