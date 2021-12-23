import { MiaModel } from "@agencycoda/mia-core";

export class MiaShipping extends MiaModel {
    id: number = 0;
    order_id: number = 0;
    status: number = 0;
    date_delivered: string = '';
    origin_address: string = '';
    origin_latitude: string = '';
    origin_longitude: string = '';
    destination_address: string = '';
    destination_latitude: string = '';
    destination_longitude: string = '';
    provider: number = 0;
    code: string = '';
    created_at: string = '';
    updated_at: string = '';

}