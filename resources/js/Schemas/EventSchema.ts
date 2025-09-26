import * as z from 'zod';
import { DescriptionSchema, FileSchema, TitleSchema } from './BaseSchemas';
export const EventSchema = z.object({
    title: TitleSchema,
    description: DescriptionSchema,
    end_date: z.string().min(1, 'Date is required'),
    start_date: z.string().min(1, 'Date is required'),
    location: z.string().min(2, 'Too short').max(100, 'Too long'),
    image: FileSchema,
});
export type Event = z.infer<typeof EventSchema>;
