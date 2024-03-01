<?php

namespace App\Helpers;

interface IDocTypes
{

    const PDF = 'pdf';
    const CNIC_DOC = 'cnic_doc';
    const CNIC_STATUS = 'cnic_doc_status';
    const CNIC_CREATE_DATE = 'cnic_created_date';

    const LICENSE_DOC = 'license_doc';
    const LICENSE_STATUS = 'license_doc_status';
    const LICENSE_CREATE_DATE = 'license_created_date';

    const REGISTER_DOC = 'registration_form_doc';
    const REGISTER_STATUS = 'registration_form_doc_status';
    const REGISTER_CREATE_DATE = 'registration_form_created_date';
}
