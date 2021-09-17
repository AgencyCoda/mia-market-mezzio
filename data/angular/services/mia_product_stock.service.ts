import { Injectable } from '@angular/core';
import { MiaProductStock } from '../entities/mia_product_stock';
import { MiaBaseCrudHttpService } from '@agencycoda/mia-core';
import { HttpClient } from '@angular/common/http';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root'
})
export class MiaProductStockService extends MiaBaseCrudHttpService<MiaProductStock> {

  constructor(
    protected http: HttpClient
  ) {
    super(http);
    this.basePathUrl = environment.baseUrl + 'mia_product_stock';
  }
 
}