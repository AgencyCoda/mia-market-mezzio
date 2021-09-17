import { MiaModel } from "@agencycoda/mia-core";

export class MiaProductChild extends MiaModel {
    id: number = 0;
    product_id: number = 0;
    stock: number = 0;
    color_type: number = 0;
    group: string = '';

}