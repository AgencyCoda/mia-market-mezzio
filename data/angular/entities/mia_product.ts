import { MiaModel } from "@agencycoda/mia-core";

export class MiaProduct extends MiaModel {
    id: number = 0;
    title: string = '';
    sku: string = '';
    slug: string = '';
    photo_main: string = '';
    stock: number = 0;
    caption: string = '';
    photos: string = '';
    store_id: number = 0;
    created_at: string = '';
    updated_at: string = '';
    deleted: number = 0;

}