import { Injectable } from '@angular/core';
import { MiaStorePermission } from '../entities/mia_store_permission';
import { MiaBaseCrudHttpService } from '@agencycoda/mia-core';
import { HttpClient } from '@angular/common/http';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root'
})
export class MiaStorePermissionService extends MiaBaseCrudHttpService<MiaStorePermission> {

  constructor(
    protected http: HttpClient
  ) {
    super(http);
    this.basePathUrl = environment.baseUrl + 'mia_store_permission';
  }
 
}