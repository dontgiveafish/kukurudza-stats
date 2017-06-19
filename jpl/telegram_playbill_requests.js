function main() {
    return Events({
        from_date: $from_date,
        to_date:   $to_date
    })
    .filter(function(event) {
        return event.name == "telegram_playbill_request";
    })
}
