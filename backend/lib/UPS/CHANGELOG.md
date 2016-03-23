# CHANGELOG

## 0.7.6 (released 04-03-2016)

- Add extra parameters for filtering on Tracking API

## 0.7.5 (released 01-03-2016)

- Improved Address Validation returned object

## 0.7.4 (released 21-02-2016)

- Bugfix: switched node names in XAV

## 0.7.3 (released 17-02-2016)

- Mail Innovation support in Tracking    
- Option to get a result object from the Validation class with several methods to make you process the results easier. Does not introduce backwords incompatibility, as it's an optional feature.

## 0.7.2 (released 09-01-2016)

- Bugfix: Use SoapRequest instead of Request in Tradeability

## 0.7.1 (released 23-11-2015)

- Adds support for a second reference number

## 0.7.0 (released 16-11-2015)

- **[!]** Default ShipFrom on Shipment class not set anymore in constructor (ShipFrom is optional)
- Adds support for cash on delivery for shipments

Items marked with **[!]**  may incur backwards incompatibility.

## 0.6.3 (released 10-11-2015)

- Improvement in parsing XML

## 0.6.2 (released 10-11-2015)

- Add Landed Cost request of Tradeability API (using SOAP). Tradeability consist of 4 endpoints, of which now one is implemented.

## 0.6.1 (released 30-10-2015)

- Add option to use the Tracking API also when supplying a ReferenceNumber

## 0.6.0 (released 25-09-2015)

- Extra check on response in QuantumView, when no response it gave an error
- Added ShipmentRequestLabelSpecification class for easier options setting
- Added ShipmentRequestReceiptSpecification class for easier options setting
- **[!]** Shipment class dropped some public properties in favor of private properties and setter/getter methods.
- **[!]** `confirm` and `accept` methods of Shipping class now receive Shipment, ShipmentRequestLabelSpecification and
ShipmentRequestReceiptSpecification

Items marked with **[!]**  may and will incur backwards incompatibility.

## 0.5.2 (released 16-09-2015)

- TimeInTransit ServiceSummary results should be array of summaries, which was not the case when 1 result

## 0.5.1 (released 08-09-2015)

- Limit alternate delivery address names to 35 characters

## 0.5.0 (released 26-08-2015)

- Added UTF8 compatibility for UPS responses
- Added Guzzle to handle requests
- Changed required PHP version to 5.5
- Removed Autoloader in favor of composer
