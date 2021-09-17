import { MiaModel } from "@agencycoda/mia-core";

export class MiaStore extends MiaModel {
    id: number = 0;
    title: string = '';
    slug: string = '';
    category_id: number = 0;
    caption: string = '';
    photos: string = '';
    address: string = '';
    address_number: string = '';
    city_id: number = 0;
    zip_code: string = '';
    photo_featured: string = '';
    website: string = '';
    facebook: string = '';
    instagram: string = '';
    twitter: string = '';
    vision: string = '';
    created_at: string = '';
    updated_at: string = '';
    deleted: number = 0;

}