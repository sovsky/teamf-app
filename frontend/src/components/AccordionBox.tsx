import {
    Accordion,
    AccordionContent,
    AccordionItem,
    AccordionTrigger,
  } from "@/components/ui/accordion"
  
  export function AccordionBox({item}) {
    return (
      <Accordion type="single" collapsible className="w-full py-1.5">
        <AccordionItem value="item-1">
          <AccordionTrigger>{item.header}</AccordionTrigger>
          <AccordionContent>
          {item.content}
          </AccordionContent>
        </AccordionItem>
      </Accordion>
    )
  }
  