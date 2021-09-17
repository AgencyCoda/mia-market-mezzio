import { Injectable } from '@angular/core';
import { MiaProduct } from '../entities/mia_product';
import { MiaBaseCrudHttpService } from '@agencycoda/mia-core';
import { HttpClient } from '@angular/common/http';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root'
})
export class MiaProductService extends MiaBaseCrudHttpService<MiaProduct> {

  constructor(
    protected http: HttpClient
  ) {
    super(http);
    this.basePathUrl = environment.baseUrl + 'mia_product';
  }
 
}