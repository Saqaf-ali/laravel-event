import * as z from 'zod';

export const TitleSchema = z.string().min(1, 'Too short').max(100, 'Too long');
export const DescriptionSchema = z.string().min(2, 'Too short').or(z.literal('')).optional();
export const PriceSchema = z.number().min(0, 'Price must be positive').max(1000000, 'Too expensive');
export const DateSchema = z.date();
export const TimeSchema = z.string().regex(/^([0-9]{2}):([0-9]{2})$/, 'Invalid time format (HH:MM)');
export const LocationSchema = z.string().min(2, 'Too short').max(100, 'Too long');
export const ImageSchema = z.string().url('Invalid URL');

export const FileSchema = z
    .instanceof(File, { message: 'Image is required.' })
    .refine((file) => file.size > 0, { message: 'Image is required.' })
    .refine((file) => file.size <= 5000000, { message: `Max image size is 5MB.` })
    .refine(
        (file) => ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'].includes(file.type),
        `Only .jpg, .jpeg, .png and .webp formats are supported.`,
    );
